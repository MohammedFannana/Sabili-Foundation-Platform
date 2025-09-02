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
        </style>

    @endpush

    <section class="mt-1">

        <x-alert name="success" />
        <x-alert name="danger" />



        {{-- section header component --}}
        <div>

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                <h3> توزيع الكفالات </h3>
                <button class="submit-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">إضافة كفالة </button>
            </div>

            <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content p-4">
                        <div class="modal-header justify-content-center border-bottom-0">
                            <h1 class="modal-title fs-5"> بيانات الكفالة </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body border-bottom-0">
                            <form action="{{route('sponsorship.create')}}" method="POST">
                                @csrf

                                <div>
                                    <label for=""> أشهر الكفالة </label>
                                    <div class="">

                                        <div class="d-flex align-items-center">

                                            <div class="w-50">
                                                <input type="checkbox" name="duration[]" value="1" id="month_1">
                                                <label for="month_1">شهر 1</label>
                                            </div>

                                            <div class="w-50">
                                                <input type="checkbox" name="duration[]" value="2" id="month_2">
                                                <label for="month_2">شهر 2</label>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center">
                                            <div class="w-50">
                                                <input type="checkbox" name="duration[]" value="3" id="month_3">
                                                <label for="month_3">شهر 3</label>
                                            </div>

                                            <div class="w-50">
                                                <input type="checkbox" name="duration[]" value="4" id="month_4">
                                                <label for="month_4">شهر 4 </label>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center">
                                            <div class="w-50">
                                                <input type="checkbox" name="duration[]" value="5" id="month_5">
                                                <label for="month_5">شهر 5</label>
                                            </div>

                                            <div class="w-50">
                                                <input type="checkbox" name="duration[]" value="6" id="month_6">
                                                <label for="month_6">شهر 6</label>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center">
                                            <div class="w-50">
                                                <input type="checkbox" name="duration[]" value="7" id="month_7">
                                                <label for="month_7">شهر 7</label>
                                            </div>


                                            <div class="w-50">
                                                <input type="checkbox" name="duration[]" value="8" id="month_8">
                                                <label for="month_8">شهر 8</label>
                                            </div>
                                        </div>


                                        <div class="d-flex align-items-center">
                                            <div class="w-50">
                                                <input type="checkbox" name="duration[]" value="9" id="month_9">
                                                <label for="month_9">شهر 9</label>
                                            </div>

                                            <div class="w-50">
                                                <input type="checkbox" name="duration[]" value="10" id="month_10">
                                                <label for="month_10">شهر 10</label>
                                            </div>
                                        </div>


                                        <div class="d-flex align-items-center">
                                            <div class="w-50">
                                                <input type="checkbox" name="duration[]" value="11" id="month_11">
                                                <label for="month_11">شهر 11</label>
                                            </div>

                                            <div class="w-50">
                                                <input type="checkbox" name="duration[]" value="12" id="month_12">
                                                <label for="month_12">شهر 12</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <x-form.input name="amount" type="text" label="قيمة الكفالة الشهرية" />
                                </div>


                                <button type="submit" class="submit-btn mt-3 w-100">تأكيد</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>


            <p style="color: rgba(36, 36, 36, 0.6);font-size:16px">
                يمكنك البحث بكود اليتيم لتوزيع الكفالات المستحقة.
            </p>

        </div>

        <form action="{{route('orphans.sponsorship.index')}}" method="GET" enctype="multipart/form-data">

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

                                @if($orphan->wallet_owner)
                                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                                        <span class="fw-bold"> اسم صاحب المحفظة:  </span>
                                        <span class="value"> {{$orphan->wallet_owner}} </span>
                                    </div>
                                @endif

                                @if($orphan->owner_phone_linked_wallet)
                                    <div class="col-12 mb-4">
                                        <span class="fw-bold">رقم الجوال المرتبط بالمحفظة: </span>
                                        <span class="value"> {{$orphan->owner_phone_linked_wallet}} </span>
                                    </div>
                                @endif

                            </div>



                        </div>

                    </div>
                </div>


                <button  id="openModalBtn" class="submit-btn submit-group-sponsorship">
                    <span>تسليم الكل دفعة واحدة  </span>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content p-5">
                            <div class="modal-header justify-content-center border-bottom-0">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">تأكيد التسليم</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div>

                                <div class="modal-body border-0 fw-bold text-center fs-5">
                                    هل أنت متأكد من تسليم الكفالة؟
                                </div>

                            </div>

                            <div class="modal-body border-bottom-0">
                                <form class="mb-3" action="{{route('orphans.sponsorship.delivery')}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="col-12  mb-4">
                                        <label class="mb-2 fw-bold">  إيصال الدفع
                                            <span class="text-danger">*</span>
                                        </label> <br>
                                        <label for="payment_receipt1" class="custom-file-upload text-center w-100" style="color:#777a78;">
                                            <img src="{{asset('assets/images/file.png')}}" alt="" width="50px" height="50px"> <br>
                                            اسحب الملف هنا أو اضغط لاختياره
                                        </label>
                                        <x-form.input name="payment_receipt" class="hidden-file-style" type="file" id="payment_receipt1" style="display: none;"/>
                                    </div>

                                    <input type="hidden" name="sponsorship_ids" id="selected-sponsorship-ids">
                                    <button type="submit" class="submit-btn mt-3 w-100">تأكيد التسليم</button>
                                </form>
                                <button type="button" class="btn w-100 text-white" style="background-color: rgba(246, 92, 92, 1)" data-bs-dismiss="modal">إلغاء</button>

                            </div>
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
                                <th scope="col" style="border-top-left-radius:15px">الاجراء</th>
                            </tr>
                        </thead>

                        <tbody>



                            @forelse ($orphan->activeSponsorship as $sponsorship)

                                <tr>
                                    @if ($sponsorship->status === 'لم يتم التسليم')

                                        <td> <input type="checkbox" name="select_ids[]" class="orphan-checkbox" value="{{$sponsorship->id}}" > </td>
                                    @else
                                       <td> - </td>
                                    @endif

                                    @php
                                        if($sponsorship->start_date){
                                            $startDate = \Carbon\Carbon::parse($sponsorship->start_date);
                                        }else {
                                            $startDate = \Carbon\Carbon::now();
                                        }
                                        $endDate = $startDate->copy()->addMonths($sponsorship->duration); // تاريخ النهاية حسب المدة
                                    @endphp

                                    <td>{{ $sponsorship->duration }}</td>
                                        <td>
                                            @if ($sponsorship->start_date) {{$sponsorship->start_date}} @else {{ $startDate->format('Y-m-d') }} @endif
                                        </td>
                                    <td>{{ $endDate->format('Y-m-d') }}</td>

                                    <td> {{$sponsorship->amount}} </td>
                                    <td class="fw-semibold"> {{$sponsorship->status}} </td>
                                    @if ($sponsorship->status === 'لم يتم التسليم')
                                        <td class="d-flex flex-wrap gap-1">
                                            <button class="submit-sponsorship text-decoration-none mb-1 btn btn-outline-success  ps-5 pe-5" data-bs-toggle="modal" data-id="{{ $sponsorship->id }}" data-bs-target="#singleSubmitSponsorshipModal"> تسليم </button>
                                        </td>
                                    @else
                                        <td  class="d-flex flex-wrap gap-1">
                                            <button class="text-decoration-none p-1 ps-2 pe-2 submit-btn" style="cursor:context-menu"> تم التسليم </button>
                                        </td>
                                    @endif


                                </tr>

                            @empty
                                <td colspan="8" class="fs-4 text-white text-center" style="background-color: var(--primary-color)"> لا يوجد كفالات لعرضها </td>
                            @endforelse


                        </tbody>

                    </table>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="singleSubmitSponsorshipModal" tabindex="-1" aria-labelledby="sponsorshipModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                        <div class="modal-header border-0">
                            <h5 class="modal-title" id="sponsorshipModalLabel">تأكيد التسليم</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                        </div>

                        <div class="modal-body border-0 fw-bold text-center fs-5">
                            هل أنت متأكد من تسليم الكفالة؟
                        </div>

                        <div class="modal-footer border-0 justify-content-center mb-2">
                            <form class="w-50" action="{{route('orphans.sponsorship.delivery')}}" method="post" enctype="multipart/form-data">
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
                                <input type="hidden" name="sponsorship_ids" id="singleOrphanId">
                                <button type="submit" class="submit-btn w-100 rounded"> تأكيد التسليم </button>
                            </form>
                            <button type="button" class="btn w-50 text-white" style="background-color: rgba(246, 92, 92, 1)" data-bs-dismiss="modal">إلغاء</button>

                        </div>

                        </div>
                    </div>
                </div>



            @else
                <div class="alert alert-danger mt-3">
                    لا يوجد يتيم بهذا الكود.
                </div>
            @endif



        @endif

    </section>

    {{-- for sponsorship opertion --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const waitButtons = document.querySelectorAll('.submit-sponsorship');
            const orphanIdInput = document.getElementById('singleOrphanId');

            waitButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const orphanId = this.getAttribute('data-id');
                    orphanIdInput.value = orphanId;
                });
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.orphan-checkbox');
            const selectedWaitingIdsInput = document.getElementById('selected-sponsorship-ids');
            const openModalBtn = document.getElementById('openModalBtn');

            let selectedIds = [];

            function initializeSelectedIds() {
                selectedIds = [];
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        selectedIds.push(checkbox.value);
                    }
                });
                selectedWaitingIdsInput.value = selectedIds.join(',');
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
                });
            });

            // منع فتح المودال إذا لم يكن هناك عناصر محددة
            openModalBtn.addEventListener('click', function (e) {
                if (selectedIds.length === 0) {
                    alert("يرجى تحديد كفالة واحدة على الأقل قبل التسليم.");
                    return;
                }

                // فتح المودال يدويًا
                const modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
                modal.show();
            });
        });
    </script>



</x-main-layout>
