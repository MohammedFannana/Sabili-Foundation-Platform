
<div class="intro2 mb-3  justify-content-between align-items-center" id="actionButtons">
    <div class="d-flex align-items-center gap-1">
        <a href="#" id="openEmailModal" class="btn text-white" style="background-color: var(--primary-color)">
            <img src="{{asset('assets/icon/mail.png')}}" alt="">
            <span> إرسال بريد الكتروني </span>
        </a>

        <!--email Modal -->
        <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
            <div class="modal-dialog  modal-lg modal-dialog-centered">
                <div class="modal-content p-4">
                    <div class="modal-header justify-content-center border-bottom-0">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel1">إرسال بريد إلكتروني للأيتام</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body border-bottom-0">
                        <form action="{{ route('orphans.email.send') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="orphan_ids" id="selectedOrphanIds">

                            <div class="mb-3">
                                <x-form.input name="to" type="text" label="إلى" id="toField" readonly />
                            </div>

                            <div class="mb-3">
                                <x-form.input name="subject" type="text" label="الموضوع" placeholder="تنبيه بخصوص حالة اليتيم" />
                            </div>

                            <div>
                                <x-form.textarea name="message" label="نص الرسالة" placeholder="ادخل نص الرسالة" />
                            </div>

                            <button type="submit" class="submit-btn mt-3 w-100">إرسال</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid var(--primary-color);color:var(--primary-color)">
                <img src="{{asset('assets/icon/download.png')}}" alt="">
                <span> تصدير النتائج </span>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <button type="button" class="dropdown-item border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#exportModal" data-export-type="pdf">
                        تحميل ملف PDF
                    </button>
                </li>
                <li>
                    <button type="button" class="dropdown-item border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#exportModal" data-export-type="excel">
                        تحميل ملف Excel
                    </button>
                </li>
            </ul>

            <!-- Modal -->
            <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" id="exportForm">
                        @csrf
                        <input type="hidden" name="ids" id="export-ids">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h5 class="modal-title" id="exportModalLabel">اختيار الأعمدة للتصدير</h5>

                                <button  type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                            </div>

                            <div class="modal-body">

                                <div>
                                    <label><input type="checkbox" id="selectAllColumns"> تحديد الكل</label>
                                </div>


                                <div class="d-flex flex-wrap gap-3 w-100">

                                    <div class="form-check col-6 w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[name]" value="اسم اليتيم رباعي" id="field1">
                                        <label class="form-check-label" for="field1"> اسم اليتيم رباعي </label>
                                    </div>

                                    <div class="form-check col-6 w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[id_number]" value="رقم هوية اليتيم" id="field2">
                                        <label class="form-check-label" for="field2"> رقم هوية اليتيم </label>
                                    </div>
                                    <div class="form-check col-6 w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[birth_date]" value="تاريخ الميلاد" id="field3">
                                        <label class="form-check-label" for="field3">  تاريخ الميلاد </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[orphan_code]" value="كود اليتيم" id="field4">
                                        <label class="form-check-label" for="field4"> كود اليتيم </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[address]" value="العنوان" id="field5">
                                        <label class="form-check-label" for="field5">  العنوان </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[gender]" value="الجنس" id="field6">
                                        <label class="form-check-label" for="field6"> الجنس </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[health_status]" value="الحالة الصحية لليتيم" id="field7">
                                        <label class="form-check-label" for="field7"> الحالة الصحية لليتيم  </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[deceased_name]" value="اسم (الشهيد/ المتوفى) رباعي" id="field8">
                                        <label class="form-check-label" for="field8">  اسم (الشهيد/ المتوفى) رباعي </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[deceased_id_number]" value="رقم هوية (الشهيد/ المتوفى)" id="field9">
                                        <label class="form-check-label" for="field9">  رقم هوية (الشهيد/ المتوفى) </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[death_deceased_date]" value="تاريخ (الإستشهاد/ الوفاة)" id="field10">
                                        <label class="form-check-label" for="field10">  تاريخ (الإستشهاد/ الوفاة) </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[cause_deceased_death]" value="سبب الوفاة" id="field11">
                                        <label class="form-check-label" for="field11"> سبب الوفاة  </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[father_work]" value="هل كان الأب يعمل" id="field12">
                                        <label class="form-check-label" for="field12"> هل كان الأب يعمل  </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[nature_father_work]" value="طبيعة عمل الأب" id="field13">
                                        <label class="form-check-label" for="field13"> طبيعة عمل الأب  </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[nature_work]" value="طبيعة العمل" id="field14">
                                        <label class="form-check-label" for="field14"> طبيعة العمل  </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[mother_name]" value="اسم زوجة (الشهيد/ المتوفى) رباعي" id="field15">
                                        <label class="form-check-label" for="field15"> اسم زوجة (الشهيد/ المتوفى) رباعي  </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[mother_id_number]" value="رقم هوية زوجة (الشهيد/ المتوفى)" id="field16">
                                        <label class="form-check-label" for="field16"> رقم هوية زوجة (الشهيد/ المتوفى)  </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[mother_birth_date]" value="تاريخ ميلاد الأم" id="field17">
                                        <label class="form-check-label" for="field17">  تاريخ ميلاد الأم </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[mother_status]" value="حالة الأم" id="field18">
                                        <label class="form-check-label" for="field18"> حالة الأم  </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[nature_mother_work]" value="طبيعة عمل الأم" id="field19">
                                        <label class="form-check-label" for="field19"> طبيعة عمل الأم  </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[guardian_name]" value="اسم الوكيل رباعي" id="field20">
                                        <label class="form-check-label" for="field20"> اسم الوكيل رباعي  </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[guardian_id_number]" value="رقم هوية الوكيل" id="field21">
                                        <label class="form-check-label" for="field21"> رقم هوية الوكيل  </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[guardian_relation]" value="صلة القرابة" id="field22">
                                        <label class="form-check-label" for="field22">  صلة القرابة </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[phone]" value="رقم جوال أساسي" id="field23">
                                        <label class="form-check-label" for="field23"> رقم جوال أساسي  </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[phone1]" value="رقم جوال ثانوي" id="field24">
                                        <label class="form-check-label" for="field24"> رقم جوال ثانوي  </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[email]" value="البريد الالكتروني" id="field25">
                                        <label class="form-check-label" for="field25">  البريد الالكتروني </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[bank_name]" value="اسم البنك" id="field26">
                                        <label class="form-check-label" for="field26"> اسم البنك  </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[bank_account_owner]" value="اسم صاحب الحساب رباعي" id="field27">
                                        <label class="form-check-label" for="field27"> اسم صاحب الحساب رباعي  </label>
                                    </div>

                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[bank_owner_id_number]" value="رقم هوية صاحب الحساب" id="field28">
                                        <label class="form-check-label" for="field28">  رقم هوية صاحب الحساب </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[phone_number_linked_bank]" value="رقم الجوال المرتبط بالحساب البنكي" id="field29">
                                        <label class="form-check-label" for="field29"> رقم الجوال المرتبط بالحساب البنكي </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[bank_account_number]" value="رقم الحساب البنكي" id="field30">
                                        <label class="form-check-label" for="field30">  رقم الحساب البنكي </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[wallet_owner]" value="اسم صاحب المحفظة" id="field31">
                                        <label class="form-check-label" for="field31">  اسم صاحب المحفظة </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[wallet_owner_id_number]" value="رقم هوية صاحب المحفظة" id="field32">
                                        <label class="form-check-label" for="field32"> رقم هوية صاحب المحفظة  </label>
                                    </div>
                                    <div class="form-check w-50">
                                        <input class="form-check-input export-field" type="checkbox" name="fields[owner_phone_linked_wallet]" value="رقم الجوال المرتبط بالمحفظة" id="field33">
                                        <label class="form-check-label" for="field33"> رقم الجوال المرتبط بالمحفظة  </label>
                                    </div>
                                </div>

                                <!-- أضف باقي الحقول حسب الحاجة -->
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">تأكيد </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>


    </div>

    <div class="d-flex flex-warp gap-1">
        <form method="POST" action="{{ route('orphans.action.approve') }}" id="approve-form">
            @csrf
            <input type="hidden" name="ids" id="selected-ids">
            <button type="submit" class="btn text-white" style="background-color: rgba(59, 207, 112, 1);">
                <img src="{{asset('assets/icon/true.png')}}" alt="" class="mb-1">
                <span> اعتماد المحدد </span>
            </button>
        </form>

        {{-- delete button --}}
        <button class="submit btn-delete btn btn-danger delete-selected">
            <img src="{{asset('assets/icon/delete.png')}}" alt="" class="mb-1">
            <span> حذف المحدد </span>
        </button>

        <form id="deleteForm" action="{{route('orphans.action.delete')}}" method="post" style="display: none" >
            @csrf
            @method('delete')
            <input type="hidden" name="delete_ids" id="selected-delete-ids">
        </form>

    </div>

</div>

<div class="table-responsive">
    <table class="table align-middle">

        <thead class="table-info">
            <tr>
                <th style="border-top-right-radius:15px"></th>
                <th>الاسم</th>
                <th>رقم الهوية</th>
                <th>رقم كود اليتيم</th>
                <th>العمر</th>
                <th>الجنس</th>
                <th>سبب الإحالة للانتظار</th>
                {{-- <th>حالة اليتم</th> --}}
                <th style="border-top-left-radius:15px">الإجراءات</th>

            </tr>
        </thead>

        <tbody>

            @forelse ($orphans as $orphan)

                <tr>
                    <td> <input type="checkbox" name="select_ids[]" class="orphan-checkbox" value="{{$orphan->id}}"  data-name="{{$orphan->name}}"> </td>
                    <td> <a href="{{route('orphan.show' , $orphan->id)}}" class="text-decoration-none" style="cursor: pointer"> {{$orphan->name}} </a> </td>
                    <td> {{$orphan->id_number}} </td>
                    <td> {{$orphan->orphan_code}} </td>
                    @php
                        use Carbon\Carbon;

                        $birthDate = Carbon::parse($orphan->birth_date);
                        $now = Carbon::now();
                        $years = $birthDate->diffInYears($now);
                        $months = $birthDate->diffInMonths($now);
                        $days = $birthDate->diffInDays($now);
                    @endphp

                    <td>
                        @if ($years > 0)
                            {{ $years }} سنوات
                        @elseif ($months > 0)
                            {{ $months }} أشهر
                        @else
                            {{ $days }} أيام
                        @endif
                    </td>
                    <td> {{$orphan->gender}} </td>
                    <td> {{$orphan->waiting_reason}}</td>
                    {{-- <td> يتيم الأب </td> --}}
                    <td class="d-flex flex-wrap gap-1">

                        {{-- approve button --}}
                        <form method="POST" action="{{ route('orphans.action.approve') }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="ids" value="{{ $orphan->id }}">
                            <button class="btn btn-outline-success">اعتماد</button>
                        </form>

                        {{-- delete-btn --}}
                        <div>
                            <button  class="submit d-flex btn-delete btn btn-outline-danger" >
                                حذف
                            </button>

                            <form  action="{{route('orphans.action.delete')}}" method="post" style="display: none">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="delete_ids" value="{{ $orphan->id }}">

                            </form>
                        </div>

                    </td>

                </tr>

            @empty

                <td colspan="8" class="fs-4 text-center" style="color: var(--primary-color)">  لا يوجد ايتام قيد الانتظار مسجلين في النظام </td>

            @endforelse

        </tbody>

    </table>
</div>




@push('scripts')

<script>

    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.orphan-checkbox');
        const actionButtons = document.getElementById('actionButtons');
        const selectedIdsInput = document.getElementById('selected-ids');
        const selectedDeleteIdsInput = document.getElementById('selected-delete-ids');

        let selectedIds = [];

        // تحديث ظهور أزرار الإجراءات
        function toggleActionButtons() {
            const checkedBoxes = document.querySelectorAll('.orphan-checkbox:checked');
            if (checkedBoxes.length > 0) {
                actionButtons.classList.add('show');
            } else {
                actionButtons.classList.remove('show');
            }
        }

        // تهيئة selectedIds بناءً على checkboxes المختارة عند تحميل الصفحة
        function initializeSelectedIds() {
            selectedIds = [];
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selectedIds.push(checkbox.value);
                }
            });
            selectedIdsInput.value = selectedIds.join(',');
            selectedDeleteIdsInput.value = selectedIds.join(',');
        }

        // استدعاء التهيئة الأولى عند التحميل
        initializeSelectedIds();
        toggleActionButtons();

        // حدث تغيير في أي checkbox
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

                selectedIdsInput.value = selectedIds.join(',');
                selectedDeleteIdsInput.value = selectedIds.join(',');

                toggleActionButtons();
            });
        });
    });

</script>

{{-- script for send email --}}
<script>
    document.getElementById('openEmailModal').addEventListener('click', function (e) {
        e.preventDefault();

        const selectedCheckboxes = document.querySelectorAll('.orphan-checkbox:checked');
        let names = [];
        let ids = [];

        selectedCheckboxes.forEach(cb => {
            names.push(cb.getAttribute('data-name'));
            ids.push(cb.value);
        });

        document.getElementById('toField').value = names.join(', ');
        document.getElementById('selectedOrphanIds').value = ids.join(',');

        // افتح المودال يدويًا
        const emailModal = new bootstrap.Modal(document.getElementById('staticBackdrop1'));
        emailModal.show();
    });
</script>

{{-- script for export modal --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const exportButtons = document.querySelectorAll('[data-bs-target="#exportModal"]');
        const exportForm = document.getElementById('exportForm');
        const exportIdsInput = document.getElementById('export-ids');
        const selectAllColumnsCheckbox = document.getElementById('selectAllColumns');
        const fieldCheckboxes = document.querySelectorAll('.export-field');

        // حفظ نوع التصدير
        let exportType = 'pdf';

        exportButtons.forEach(button => {
            button.addEventListener('click', function () {
                exportType = this.getAttribute('data-export-type');
                // غيّر الإجراء حسب نوع التصدير
                if (exportType === 'pdf') {
                    exportForm.setAttribute('action', '{{ route("orphan.download.pdf") }}');
                } else if (exportType === 'excel') {
                    exportForm.setAttribute('action', '{{ route("orphan.download.excel") }}');
                }

                // تعبئة ids المختارة
                const selected = document.querySelectorAll('.orphan-checkbox:checked');
                const ids = Array.from(selected).map(cb => cb.value);
                exportIdsInput.value = ids.join(',');
            });
        });

        // زر تحديد الكل
        selectAllColumnsCheckbox.addEventListener('change', function () {
            fieldCheckboxes.forEach(cb => cb.checked = this.checked);
        });
    });
</script>

@endpush
