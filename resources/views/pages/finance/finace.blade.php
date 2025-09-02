<x-main-layout title="مؤسسة سبيلي الخيرية">

    @push('styles')

        <style>
            .value{
                color: rgba(36, 36, 36, 0.6)
            }

            table , td , th ,tr{
                border: none !important;
                border-bottom: none !important;
            }

            .table-info{
                --bs-table-bg: var(--third-color);
                border-top-right-radius: 10px;
                border-top-left-radius: 10px;
            }

            .button:active{
                color: white !important
            }
        </style>

    @endpush

    <section class="mt-1">

        <x-alert name="success" />
        <x-alert name="danger" />



        {{-- section header component --}}
        <div class="mb-4">

            <h3 class="mb-1"> المالية </h3>
            <p style="color: rgba(36, 36, 36, 0.6);font-size:16px">
                يمكنك البحث بكود اليتيم لمتابعة السجل المالي الكامل لليتيم.
            </p>

        </div>

        <div style="margin-right:1rem;margin-left:1rem">

            <div class="row justify-content-between mb-4">

                <div class="col-12 col-md-6 rounded d-flex gap-3 align-items-center p-2" style="background-color: var(--third-color);;width:49%">
                    <div class="p-2 rounded" style="background-color: var(--primary-color)">
                        <img src="{{asset('assets/icon/money-big.png')}}" alt="" >
                    </div>

                    <div>
                        <p class="fw-bold fs-4 mb-1" style="color: var(--primary-color)">{{$total_amounts_paid}}</p>
                        <p>إجمالي المبالغ المدفوعة</p>
                    </div>
                </div>

                <div class="col-12 col-md-6 rounded d-flex gap-3 align-items-center p-2" style="background-color: var(--third-color);;width:49%">
                    <div class="p-2 rounded" style="background-color: var(--primary-color)">
                        <img src="{{asset('assets/icon/time.png')}}" alt="" >
                    </div>

                    <div>
                        <p class="fw-bold fs-4 mb-1" style="color: var(--primary-color)">{{$total_overdue_amounts}}</p>
                        <p>إجمالي المبالغ المتأخرة</p>
                    </div>
                </div>


            </div>

            <form action="{{route('orphans.finance.index')}}" method="GET" enctype="multipart/form-data">

                <div class="d-flex row justify-content-between flex-wrap align-items-center">

                    <div class="col-12 col-sm-10">
                        <x-form.input name="orphan_code"  type="text" value="{{ old('orphan_code', request('orphan_code')) }}"  label=" كود اليتيم" placeholder="ادخل كود اليتيم" />
                    </div>

                    <div class="col-2" style="margin-top: 1.9rem">
                        <button type="submit" class="submit-btn ps-5 pe-5"> بحث </button>
                    </div>

                </div>

            </form>


            @if(request()->filled('orphan_code'))

                @if($orphan)

                    <div style="margin-right:1rem;margin-left:1rem" class="mb-5">
                        <div style="background-color: rgba(248, 250, 250, 1);" class="row mt-4 p-2 pt-4 pb-4">

                            <div class="col-12 col-md-2">

                                @if ($orphan->image && $orphan->image->personl_image)
                                    <img src="{{asset('storage/' . $orphan->image->personl_image)}}" alt="" width="130px" height="130px">
                                @else
                                    <img src="{{asset('assets/images/profile.png')}}" alt="" width="130px" height="130px">
                                @endif

                            </div>

                            <div class="col-12 col-md-10">

                                <div class="row">

                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold"> الاسم اليتيم: </span>
                                        <span class="value"> {{$orphan->name}} </span>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold"> رقم جوال أساسي: </span>
                                        <span class="value"> {{$orphan->phone}} </span>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold"> رقم جوال ثانوي:</span>
                                        <span class="value"> {{$orphan->phone1}} </span>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold">رقم هوية اليتيم:</span>
                                        <span class="value"> {{$orphan->id_number}} </span>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold"> اسم الكفيل: </span>
                                        <span class="value"> {{$orphan->guardian_name}} </span>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold"> رقم هوية الكفيل: </span>
                                        <span class="value"> {{$orphan->guardian_id_number}} </span>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold"> اسم البنك: </span>
                                        <span class="value"> {{$orphan->bank_name}}</span>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold"> رقم الحساب البنكي: </span>
                                        <span class="value"> {{$orphan->bank_account_number}} </span>
                                    </div>

                                    @if ($orphan->wallet_owner)

                                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                                            <span class="fw-bold"> اسم صاحب المحفظة:  </span>
                                            <span class="value"> {{$orphan->wallet_owner}} </span>
                                        </div>

                                    @endif


                                    @if($orphan->owner_phone_linked_wallet)
                                        <div class="col-12  mb-4">
                                            <span class="fw-bold">رقم الجوال المرتبط بالمحفظة: </span>
                                            <span class="value"> {{$orphan->owner_phone_linked_wallet}} </span>
                                        </div>
                                    @endif

                                </div>

                            </div>

                        </div>
                    </div>


                    <div class="statistics">

                        <div class="row justify-content-between mb-4">

                        <div class="col-12 col-md-6 col-lg-3 rounded d-flex gap-3 align-items-center p-2" style="background-color: var(--third-color); width:24%">
                            <div class="p-2 rounded">
                                <img src="{{asset('assets/icon/money.png')}}" alt="" >
                            </div>

                            <div>
                                <p class="fw-bold fs-4 mb-1" style="color: var(--primary-color)">{{$orphan_amount_paid }}</p>
                                <p>إجمالي المبالغ المدفوعة</p>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-3 rounded d-flex gap-3 align-items-center p-2" style="background-color: var(--third-color);width:24%">
                            <div class="p-2 rounded">
                                <img src="{{asset('assets/icon/clock.png')}}" alt="" >
                            </div>

                            <div>
                                <p class="fw-bold fs-4 mb-1" style="color: var(--primary-color)">{{$orphan_overdue_paid}}</p>
                                <p> إجمالي المبالغ المتأخرة </p>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-3 rounded d-flex gap-3 align-items-center p-2" style="background-color: var(--third-color);width:24%">
                            <div class="p-2 rounded">
                                <img src="{{asset('assets/icon/seadule.png')}}" alt="" >
                            </div>

                            <div>
                                <p class="fw-bold fs-4 mb-1" style="color: var(--primary-color)"> {{$orphan_months_covered}} </p>
                                <p> عدد الشهور المكفولة </p>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-3 rounded d-flex gap-3 align-items-center p-2" style="background-color: var(--third-color);width:24%">
                            <div class="p-2 rounded">
                                <img src="{{asset('assets/icon/seadule.png')}}" alt="" >
                            </div>

                            <div>
                                <p class="fw-bold fs-4 mb-1" style="color: var(--primary-color)"> {{$orphan_months_late}} </p>
                                <p> عدد الشهور المتأخرة </p>
                            </div>
                        </div>


                    </div>

                    </div>


                    <div class="finace-table">

                        <div class="d-flex justify-content-between align-items-center">
                            <p class="fw-bold fs-5"> كشف حساب اليتيم </p>

                            <div class="d-flex gap-2">

                                <button  id="openModalBtn" class="submit-btn submit-group-sponsorship">
                                    <span> الذهاب لتسليم كفالات هذا اليتيم  </span>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content p-5">
                                            <div class="modal-header justify-content-center border-bottom-0">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">تأكيد التسليم</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body border-0 fw-bold text-center fs-5">
                                                هل أنت متأكد من تسليم الكفالة؟
                                            </div>

                                            <div class="modal-body border-bottom-0">
                                                <form class="mb-3" action="{{route('orphans.finance.delivery')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="col-12  mb-4">
                                                        <label class="mb-2 fw-bold">  إيصال الدفع
                                                            <span class="text-danger">*</span>
                                                        </label> <br>
                                                        <label for="payment_receipt" class="custom-file-upload text-center w-100" style="color:#777a78;">
                                                            <img src="{{asset('assets/images/file.png')}}" alt="" width="50px" height="50px"> <br>
                                                            اسحب الملف هنا أو اضغط لاختياره
                                                        </label>
                                                        <x-form.input name="payment_receipt" class="hidden-file-style" type="file" id="payment_receipt" style="display: none;"/>
                                                    </div>
                                                    <input type="hidden" name="sponsorship_ids" id="selected-sponsorship-ids">
                                                    <button type="submit" class="submit-btn mt-3 w-100">تأكيد التسليم</button>
                                                </form>
                                                <button type="button" class="btn w-100 text-white" style="background-color: rgba(246, 92, 92, 1)" data-bs-dismiss="modal">إلغاء</button>

                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown">
                                    <button class="btn dropdown-toggle pt-2 pb-2" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid var(--primary-color);color:var(--primary-color)">
                                        <img src="{{asset('assets/icon/download.png')}}" alt="">
                                        <span>تصدير كشف الحساب </span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <form class="dropdown-item" action="{{route('statement.download.pdf')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="sponsorship_pdf_ids" id="selected-pdf-ids">
                                                <button type="submit" class="btn button p-0" style="color: var(--primary-color)"> تحميل ملف PDF </button>
                                            </form>
                                        </li>

                                        <li>
                                            <form class="dropdown-item" action="{{route('statement.download.excel')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="sponsorship_excel_ids" id="selected-excel-ids">
                                                <button type="submit" class="btn button p-0" style="color: var(--primary-color)"> تحميل ملف Excel </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="table-responsive mt-4">
                            <table class="table align-middle">

                                <thead class="table-info">
                                    <tr>
                                        <th scope="col" style="border-top-right-radius:15px"></th>
                                        <th scope="col"> المدة (بالأشهر)</th>
                                        <th scope="col"> من  </th>
                                        <th scope="col"> إلى  </th>
                                        <th scope="col">  المبلغ الشهري</th>
                                        <th scope="col"> الحالة </th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse ($orphan->activeSponsorship as $sponsorship)


                                        <tr class="p-1">
                                            {{-- @if ($sponsorship->status === 'لم يتم التسليم') --}}

                                                <td> <input type="checkbox" name="select_ids[]" class="orphan-checkbox" value="{{$sponsorship->id}}" /> </td>
                                            {{-- @else
                                                <td> - </td>
                                            @endif --}}

                                            @php
                                                if($sponsorship->start_date){
                                                    $startDate = \Carbon\Carbon::parse($sponsorship->start_date);
                                                }else {
                                                    $startDate = \Carbon\Carbon::now();
                                                }
                                                $endDate = $startDate->copy()->addMonths($sponsorship->duration); // تاريخ النهاية حسب المدة
                                            @endphp

                                            <td> {{ $sponsorship->duration }} </td>
                                            <td>
                                                @if ($sponsorship->start_date) {{$sponsorship->start_date}} @else {{ $startDate->format('Y-m-d') }} @endif
                                            </td>
                                            <td>{{ $endDate->format('Y-m-d') }}</td>
                                            <td> {{$sponsorship->amount}} </td>

                                            @if ($sponsorship->status === 'لم يتم التسليم')
                                                <td class="rounded d-flex justify-content-center w-75" style="color: rgba(239, 163, 0, 1);background-color:rgba(255, 219, 126, 0.17)"> لم يتم التسليم </td>
                                            @else
                                                <td class="rounded  d-flex justify-content-center w-75" style="color: rgba(30, 183, 85, 1); background-color:rgba(230, 255, 239, 1)"> تم التسليم </td>
                                            @endif

                                        </tr>

                                    @empty
                                        <td colspan="7" class="fs-4 text-white" style="background-color: var(--primary-color)"> لا يوجد كفالات لعرضها </td>
                                    @endforelse

                                </tbody>

                            </table>
                        </div>

                    </div>

                @else
                    <div class="alert alert-danger mt-3">
                        لا يوجد يتيم لهذا الكود.
                    </div>
                @endif

            @endif




        </div>





    </section>


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.orphan-checkbox');
            const selectedWaitingIdsInput = document.getElementById('selected-sponsorship-ids');
            const selectedExcelIdsInput = document.getElementById('selected-excel-ids');
            const selectedPdfIdsInput = document.getElementById('selected-pdf-ids');

            const openModalBtn = document.getElementById('openModalBtn');

            // أزرار التصدير
            const pdfForm = document.querySelector('form[action="{{route('statement.download.pdf')}}"]');
            const excelForm = document.querySelector('form[action="{{route('statement.download.excel')}}"]');

            let selectedIds = [];

            function initializeSelectedIds() {
                selectedIds = [];
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        selectedIds.push(checkbox.value);
                    }
                });
                selectedWaitingIdsInput.value = selectedIds.join(',');
                selectedExcelIdsInput.value = selectedIds.join(',');
                selectedPdfIdsInput.value = selectedIds.join(',');
            }

            initializeSelectedIds();

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const id = this.value;

                    if (this.checked) {
                        if (!selectedIds.includes(id)) {
                            selectedIds.push(id);
                        }
                    } else {
                        selectedIds = selectedIds.filter(item => item !== id);
                    }

                    selectedWaitingIdsInput.value = selectedIds.join(',');
                    selectedExcelIdsInput.value = selectedIds.join(',');
                    selectedPdfIdsInput.value = selectedIds.join(',');
                });
            });

            // منع فتح المودال إذا لم يكن هناك عناصر محددة
            openModalBtn.addEventListener('click', function (e) {
                if (selectedIds.length === 0) {
                    alert("يرجى تحديد كفالة واحدة على الأقل قبل التسليم.");
                    return;
                }

                const modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
                modal.show();
            });

            // منع تنزيل PDF إذا ما في عناصر
            pdfForm.addEventListener('submit', function (e) {
                if (selectedIds.length === 0) {
                    e.preventDefault();
                    alert("يرجى تحديد كفالة واحدة على الأقل قبل تحميل ملف PDF.");
                }
            });

            // منع تنزيل Excel إذا ما في عناصر
            excelForm.addEventListener('submit', function (e) {
                if (selectedIds.length === 0) {
                    e.preventDefault();
                    alert("يرجى تحديد كفالة واحدة على الأقل قبل تحميل ملف Excel.");
                }
            });
        });

    </script>
@endpush

</x-main-layout>
