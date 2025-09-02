<!DOCTYPE html>
<html lang="ar">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    <style>
        body {
            font-family: 'arialarabic';
            direction: rtl;
            margin: auto !important;
            margin-top: 2px !important;
            padding: 0 !important;
            width: 210mm !important; /* عرض A4 */
            height: 297mm !important; /* ارتفاع A4 */
            box-sizing: border-box !important;
        }

        .container{
            width: 100%;
            height: 100%;
        }


        .cell{
            text-align: center;
            margin: 0;
            padding:5px 0 5px 5px;
        }

        /* .border{
            border:1px solid #BA3A37;
        } */

        .font{
            font-weight:bold;
            text-align:start;
            font-size: 19px;

        }

        .border {
            font-size: 18px;
            border: 1px solid rgba(1, 143, 145, 1);
            box-shadow: 3px 3px 0px rgba(128, 199, 200, 1);
            direction: rtl;
            font-family: 'Arial', sans-serif;
        }


    </style>

</head>

<body>


    <div class="container">




        {{-- الدولة  and عنوان الجهة المشرفة--}}
        @foreach ($orphans as $orphan)

            <div style="width:100%">
            <!-- الشعار على اليمين -->
                <div style="float: right;margin-right:170px;width: 100%;overflow: hidden; margin-bottom: 10px;">
                    <img src="{{ public_path('assets/images/logo1.png') }}" alt="Logo" style="width:300px; height: 150px; margin-right: 10px;">
                    <div class="font" style="padding:0px;margin:0px 110px;color:#048d92;">
                        <div style="display: inline-block;padding-right:22px">  {{ now()->locale('ar')->translatedFormat('l') }} </div>
                        {{ now()->locale('ar')->translatedFormat('Y-m-d') }}
                     </div>
                </div>



            </div>



            @foreach($fields as $key => $label)

                <div style="width: 50%; float:right; overflow: hidden; margin-bottom: 12px;">
                    <p style=" width: 100%;margin-right:3px" class="cell font">{{ $label }}</p>
                    <p style="width: 90%;" class="cell border">
                        {{ $orphan->$key}}
                    </p>
                </div>

            @endforeach

            <div style="clear: both;"></div>

            <div style="page-break-after: always;"></div>

        @endforeach


    </div>

</body>

</html>
