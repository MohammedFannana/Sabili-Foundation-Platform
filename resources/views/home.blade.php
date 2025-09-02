<x-main-layout title="مؤسسة سبيلي الخيرية">

    @push('styles')

        <style>
            .notification{
                border:1px solid var(--third-color);
            }
        </style>

    @endpush

    <div class="row justify-content-between ps-2 pe-2 mb-4">

        <div class="col-12 col-md-6 rounded d-flex justify-content-between p-3 pt-4 mb-2" style="background-color: var(--third-color); width:49%">

            <p>
                <span class="fs-3 fw-semibold" style="color: var(--primary-color)"> {{$orphan_count}} </span> <br>
                <span>عدد الأيتام المكفولين</span>
            </p>

            <p>
                <img src="{{asset('assets/icon/orphan.png')}}" alt="">
            </p>

        </div>

        <div class="col-12 col-md-6 rounded d-flex justify-content-between p-3 pt-4 mb-2" style="background-color: var(--third-color); width:49%">

            <p>
                <span class="fs-3 fw-semibold" style="color: var(--primary-color)"> {{$orphan_wait_count}} </span> <br>
                <span> عدد الأيتام الجدد بانتظار التدقيق </span>
            </p>

            <p>
                <img src="{{asset('assets/icon/clock.png')}}" alt="">
            </p>

        </div>

        <div class="col-12 col-md-6 rounded d-flex justify-content-between p-3 pt-4 mb-2" style="background-color: var(--third-color); width:49%">

            <p>
                <span class="fs-3 fw-semibold" style="color: var(--primary-color)"> {{$deliveredCount}} </span> <br>
                <span> إجمالي الكفالات المستلمة هذا الشهر </span>
            </p>

            <p>
                <img src="{{asset('assets/icon/money.png')}}" alt="">
            </p>

        </div>

        <div class="col-12 col-md-6 rounded d-flex justify-content-between p-3 pt-4 mb-2" style="background-color: var(--third-color); width:49%">

            <p>
                <span class="fs-3 fw-semibold" style="color: var(--primary-color)"> {{$adultOrphansCount}} </span> <br>
                <span> عدد الأيتام الذين تجاوز عمرهم 18 سنة </span>
            </p>

            <p>
                <img src="{{asset('assets/icon/user-multiple.png')}}" alt="">
            </p>

        </div>

    </div>

    {{-- <div>
        <div class="d-flex justify-content-between mb-4">

            <div class="d-flex align-items-center gap-1">
                <img src="{{asset('assets/icon/notific.png')}}" alt="">
                <p class="mb-0 pb-0 fw-semibold fs-5">آخر الإشعارات</p>
            </div>

            <a href="{{route('notification')}}" class="d-flex align-items-center gap-1 text-decoration-none">
                <p class="mb-0 pb-0" style="color: var(--primary-color)">عرض الكل</p>
                <img src="{{asset('assets/icon/arrow.png')}}" alt="">
            </a>

        </div>

        <div>
            <p class="notification rounded p-2">
                1. 🧒 اليتيم محمد أحمد تجاوز عمر 18 عامًا.
            </p>

            <p class="notification rounded p-2">
                2. ✅ تم اعتماد طلب إضافة اليتيم رزان خالد.
            </p>

            <p class="notification rounded p-2">
                3. 📤 تم استلام كفالة شهر 6 لليتيم ناصر.
            </p>

            <p class="notification rounded p-2">
                4. ⚠️ لم يتم استلام كفالة شهر 5 لليتيم سارة.

            </p>

            <p class="notification rounded p-2">
                5. 👨‍👩‍ تم تسجيل أسرة جديدة تحت اسم "عائلة الحسين".

            </p>
        </div>

    </div> --}}

</x-main-layout>
