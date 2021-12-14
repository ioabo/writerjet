<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Ministry;
use Dompdf\Dompdf;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class dompdfController extends Controller
{

    public function genPDF($id)
    {

        // instantiate and use the dompdf class
        $dompdf = App::make('dompdf.wrapper');
        $document = Document::where('id', $id)->get();

        $SRO = $document[0]->from;

        $ministry = Ministry::where('SRO', $SRO)->get();

        $date_now = now();
        $dompdf->loadView('pdfs.letter', compact('document', 'date_now', 'ministry'));
        //$dompdf->loadHtml(file_get_contents("../resources/views/pdfs/letter.blade.php"));
        $dompdf->setPaper('A4', 'portrait');

        //generate random numbers to form part of the file name
        $random = Str::random(10);

        $access_url = 'storage/pdf/doc_' . $document[0]->category_id . '_' . $id . '_' . $random . '.pdf';
        $url = 'public/pdf/doc_' . $document[0]->category_id . '_' . $id . '_' . $random . '.pdf';
        $status = 'Final';

        Storage::put($url, $dompdf->output());

        $this->updateURL($id, $access_url, $status);
        //dd();
        // return $dompdf->stream('invoice2.pdf');
        return response()->json($url);
    }

    public function web_view()
    {

        $document = Document::where('id', 10)->get();

        $date_now = now();

        return view('pdfs.letter', compact('document', 'date_now'));
    }
    public function updateURL($id, $url, $status)
    {
        $document = Document::find($id);

        // Make sure you've got the Page model
        if ($document) {
            $document->pdf_url = $url;
            $document->status = $status;
            $document->save();
        }
    }
    public function downloadPDF($id)
    {
        // $dompdf = App::make('dompdf.wrapper');
        $document = Document::find($id);

        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        // return response()->download($document->pdf_url);
        return response()->make(storage_path('app/public/pdf/doc_Allowance_7.pdf', 'doc_Allowance_7.pdf', $headers));
        //  return $dompdf->stream($document->pdf_url);
    }
}
