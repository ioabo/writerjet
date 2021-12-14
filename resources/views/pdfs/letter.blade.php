<html>

<head>

    <style>
        @page {
            margin: 80px 70px;
        }

        #header {
            position: fixed;
            left: 0px;
            top: -50px;
            right: 0px;
            height: 50px;
            text-align: left;
            font-size: 8px;
        }

        #footer {
            position: fixed;
            left: 0px;
            bottom: -20px;
            right: 0px;
            height: 50px;
            padding-left: 10px;
            text-align: center;
            font-size: 10px;
        }

        #footer .page:after {
            content: counter(page, upper-roman);
        }

        table {
            width: 100%;
            margin-bottom: 1rem;
            vertical-align: top;
            border: 1px #111311 solid;
            font-size: 14px;
            border-collapse: collapse;
        }

        .dataTable-table,
        th,
        td {
            width: 100%;
            margin-bottom: 1rem;
            vertical-align: top;
            border: 1px #111311 solid;
            font-size: 14px;
            border-collapse: collapse;
        }

        th,
        td {
            padding-left: 5px;
        }

        th {
            width: 30%;
            text-align: left;
        }

        td.subject {
            padding: 8px;
        }

        span .inline_head {
            display: inline-block;
        }

        hr {
            margin-top: 3px;
            margin-bottom: 3px;
            border-top: 0.5px solid #9da09d;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }

    </style>

<body>
    <div id="header">
        <span class="inline_head" style="float: left; text-align: left">
            Correspondence <br>WriterJet 1.0
        </span>
        <span class="inline_head" style="float: right; text-align: right">
            Document created on {{ $document[0]->created_at }} <br>
            Last modified on {{ $document[0]->updated_at }} <br>
            PDF created on {{ $date_now }} <br>
        </span>
    </div>
    <div id="footer" class="content">
        
        <span class="inline_head">
            <p class="page">Page </p>
            <div class="text-center">
            <b>{{ $ministry[0]->description }}</b>
            </div>
        </span>
    </div>
    <div id="content" style="font-size:15px;">
        <center>
            <img src="images/NationalEmblem4.png" alt="national_emblem"/>
            <br>
            <p>
                <b style="font-size: 19px;">Republic of Kiribati</b>
            </p>
            <p style="font-size: 13px">
                <hr>
                <b>PO box {{ $ministry[0]->p_o_box }}, {{$ministry[0]->address }}, Tarawa: (686) {{ $ministry[0]->phone }},
                     {{ $ministry[0]->email }}, Website: {{ $ministry[0]->website }}</b>
                <hr>
            <h4><b>MEMORANDUM</b></h4>
            </p>
        </center>
        <table class="dataTable-table">
            <tr>
                <th><b>From:</b></th>
                <td>
                    {{ $document[0]->from }}
                </td>
                <th><b>To:</b></th>
                <td>
                    <?php $TOs = explode('|', $document[0]->to); ?>
                    @foreach ($TOs as $TO)
                        {{ $TO }} <br />
                    @endforeach
                </td>
            </tr>
            <tr>
                <th><b>File Ref:</b></th>
                <td>{{ $document[0]->file_ref }}</td>
                <th><b>Attn:</b></th>
                <td>ICT Officer</td>
            </tr>
            <tr>
                <th><b>Date</b></th>
                <td>
                    {{ $document[0]->date_issued->isoFormat('ddd D MMM, YYYY') }}
                </td>
                <th><b>Cc:</b></th>
                <td>
                    <?php $CCs = explode('|', $document[0]->cc); ?>
                    @foreach ($CCs as $cc)
                        {{ $cc }} <br />
                    @endforeach
                </td>
            </tr>
            <tr>
                <td colspan="4" class="subject"><b>Subject:</b> {{ $document[0]->subject }}</td>
            </tr>
        </table>
        <br>

        <?php echo $document[0]->content; ?>
        <br /><br />
        ...........................
        <br>
        {{ Auth::user()->name }}

        <br>

        <?php
        if ($document[0]->for_secretary == true) {
            echo '<i><b>For</b></i> Secretary, PSO';
        }
        ?>

    </div>
</body>

</html>
