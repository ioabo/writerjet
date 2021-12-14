<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'staffs' => ['nullable'],
            'category_id' => ['required'],
            'from' => ['required'],
            'to' => ['required'],
            'file_ref' => ['nullable'],
            'attn' => ['nullable'],
            'date_issued' => ['required'],
            'cc' => ['nullable'],
            'subject' => ['required'],
            'content' => ['required'],
            'for_secretary' => ['nullable'],
            'status' => ['required'],
            'pdf_url' => ['nullable'],
            'user_id' => ['required'],
        ];
    }
}
