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

        @foreach($sponsorships as $sponsorship)

            <div style="width:100%">
            <!-- الشعار على اليمين -->
                <div style="float: right;margin-right:150px;width: 100%;overflow: hidden; margin-bottom: 25px;">
                    <img src="{{ public_path('assets/images/logo1.png') }}" alt="Logo" style="width:300px; height: 150px; margin-right: 10px;">
                     <div class="font" style="padding:0px;margin:0px 110px;color:#048d92;">
                        <div style="display: inline-block;padding-right:22px">  {{ now()->locale('ar')->translatedFormat('l') }} </div>
                        {{ now()->locale('ar')->translatedFormat('Y-m-d') }}
                     </div>
                </div>


            </div>

            <div style="width: 50%; float:right; overflow: hidden; margin-bottom: 12px;">
                <p style=" width: 100%;margin-right:3px" class="cell font"> اسم اليتيم </p>
                <p style="width: 90%;" class="cell border">
                    {{ $sponsorship->orphan->name}}
                </p>
            </div>

            <div style="width: 50%; float:right; overflow: hidden; margin-bottom: 12px;">
                <p style=" width: 100%;margin-right:3px" class="cell font"> رقم الهوية </p>
                <p style="width: 90%;" class="cell border">
                    {{ $sponsorship->orphan->id_number}}
                </p>
            </div>

            <div style="width: 50%; float:right; overflow: hidden; margin-bottom: 12px;">
                <p style=" width: 100%;margin-right:3px" class="cell font"> كود اليتيم </p>
                <p style="width: 90%;" class="cell border">
                    {{ $sponsorship->orphan->orphan_code}}
                </p>
            </div>

            <div style="width: 50%; float:right; overflow: hidden; margin-bottom: 12px;">
                <p style=" width: 100%;margin-right:3px" class="cell font"> مدة الكفالة (بالأشهر) </p>
                <p style="width: 90%;" class="cell border">
                    {{ $sponsorship->duration}}
                </p>
            </div>

            <div style="width: 50%; float:right; overflow: hidden; margin-bottom: 12px;">
                <p style=" width: 100%;margin-right:3px" class="cell font"> تاريخ البداية </p>
                <p style="width: 90%;" class="cell border">
                    @if ($sponsorship->start_date)
                        {{ $sponsorship->start_date}}
                    @else
                        <span style="color: red;">لا يوجد تاريخ بداية</span>
                    @endif
                </p>
            </div>

            <div style="width: 50%; float:right; overflow: hidden; margin-bottom: 12px;">
                <p style=" width: 100%;margin-right:3px" class="cell font"> تاريخ النهاية </p>
                <p style="width: 90%;" class="cell border">
                    @if ($sponsorship->start_date)
                        {{ \Carbon\Carbon::parse($sponsorship->start_date)->copy()->addMonths($sponsorship->duration)->toDateString() }}
                    @else
                        <span style="color: red;">لا يوجد تاريخ نهاية</span>
                    @endif
                </p>
            </div>

            <div style="width: 50%; float:right; overflow: hidden; margin-bottom: 12px;">
                <p style=" width: 100%;margin-right:3px" class="cell font"> مبلغ الكفالة الشهري </p>
                <p style="width: 90%;" class="cell border">
                    {{ $sponsorship->amount}}
                </p>
            </div>




            <div style="width: 50%; float:right; overflow: hidden; margin-bottom: 12px;">
                <p style=" width: 100%;margin-right:3px" class="cell font"> المبلغ الإجمالي </p>
                <p style="width: 90%;" class="cell border">
                    {{number_format(floatval($sponsorship->amount) * intval($sponsorship->duration))}}
                </p>
            </div>

            <div style="width: 50%; float:right; overflow: hidden; margin-bottom: 12px;">
                <p style=" width: 100%;margin-right:3px" class="cell font"> حالة الكفالة </p>
                <p style="width: 90%;" class="cell border">
                    {{$sponsorship->status}}
                </p>
            </div>

            <div style="width: 50%; float:right; overflow: hidden; margin-bottom: 12px;">
                <p style=" width: 100%;margin-right:3px" class="cell font"> إيصال الدفع </p>
                <img src="{{ public_path('storage/' . $sponsorship->payment_receipt) }}" alt="" height="100px" width="100%">
            </div>

            <div style="page-break-after: always;"></div>

        @endforeach



    </div>

</body>

</html>
