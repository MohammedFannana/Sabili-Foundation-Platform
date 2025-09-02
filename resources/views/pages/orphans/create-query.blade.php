<x-main-layout title="مؤسسة سبيلي الخيرية">

    @push('styles')

        <style>
            table , td , th ,tr{
                border: none !important;
                border-bottom: none !important;
            }

            .table-info{
                --bs-table-bg: var(--third-color);
                border-top-right-radius: 10px;
                border-top-left-radius: 10px;
            }

            .intro2 {
                display: none;
            }

            .intro2.show {
                display: flex;
            }

            .sponorship-btn{
                color: var(--primary-color);
                border:1px solid var(--primary-color);
                border-radius: 5px;
            }

            .sponorship-btn:hover{
                background-color: var(--primary-color);
                border:1px solid var(--primary-color);
                color:white;
                border-radius: 5px;
            }



        </style>

    @endpush


    <section class="mt-1">

        <x-alert name="success" />
        <x-alert name="danger" />

        {{-- section header --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <h4 class="mb-1">إنشاء إستعلام</h4>
        </div>
        {{-- end section header --}}

        {{-- form for creating query --}}


        <div class="mb-4">

            <form action="" method="post">
                @csrf

                {{-- Hidden input to store the page from which the query is created --}}
                <input type="hidden" name="from" value="{{$from}}">
                {{-- <div> --}}
                <div id="conditions-container">

                    <div class="d-flex align-items-center align-items-center flex-wrap gap-3 mb-2 condition-row">

                        <div>
                            <x-form.select label="ابحث حسب" name="search_by[]"
                                :options="[
                                    'name' => __('اسم اليتيم'),
                                    'id_number' => __('رقم هوية اليتيم'),
                                    'birth_date' => __('تاريخ ميلاد اليتيم'),
                                    'orphan_code' => __('كود اليتيم'),
                                    'address' => __('العنوان'),
                                    'gender' => __('جنس اليتيم'),
                                    'health_status' => __('الحالة الصحية لليتيم'),
                                    'deceased_name' => __('اسم (الشهيد/ المتوفى) رباعي'),
                                    'deceased_id_number' => __('رقم هوية (الشهيد/ المتوفى)'),
                                    'death_deceased_date' => __('تاريخ (الإستشهاد/ الوفاة) '),
                                    'cause_deceased_death' => __(' سبب الوفاة '),
                                    'father_work' => __('عمل الأب'),
                                    'nature_father_work' => __('طبيعة عمل الأب'),
                                    'nature_work' => __('طبيعة العمل'),
                                    'mother_name' => __('اسم زوجة (الشهيد/ المتوفى)'),
                                    'mother_id_number' => __('رقم هوية زوجة (الشهيد/ المتوفى)'),
                                    'mother_birth_date' => __('تاريخ ميلاد الأم '),
                                    'mother_status' => __('حالة الأم'),
                                    'mother_work' => __('عمل الأم'),
                                    'nature_mother_work' => __('طبيعة عمل الأم'),
                                    'guardian_name' => __('اسم الوكيل'),
                                    'guardian_id_number' => __('رقم هوية الوكيل'),
                                    'guardian_relation' => __('صلة القرابة الوكيل'),
                                    // 'orphan_sibling' => __('أخوة اليتيم'),
                                    'phone' => __('رقم جوال أساسي'),
                                    'phone1' => __('رقم جوال ثانوي'),
                                    'email' => __('البريد الالكتروني'),
                                ]"
                                value="name"
                                class="search-by"
                            />
                        </div>

                        <div>
                            <x-form.select label="الشرط" name="condition[]"
                                :options="['==' => __('مطابق ل')]"
                            />
                        </div>

                        <div style="width: 45%">
                            <label class="mb-2 fw-bold">القيمة</label>
                            <div class="search-input-wrapper">
                                <select name="search_value[]" class="form-select search-options"></select>
                            </div>
                        </div>

                        <button type="button" id="add-condition" class="btn" style="border: 1px solid var(--primary-color); color: var(--primary-color);margin-top:1.9rem">
                            + شرط جديد
                        </button>

                    </div>
                </div>


                <div>
                    <button class="submit-btn" type="submit">تنفيذ الاستعلام</button>
                </div>

            </form>

        </div>

        @if ($orphans)

            <div>

                @if ($from == 'auditing_addition_page')
                    <div>
                        <h3 class="mb-1"> تدقيق طلبات الإضافة </h3>
                        <p style="color: rgba(36, 36, 36, 0.6);font-size:16px">
                            راجع بيانات الأيتام المضافة حديثًا، ثم قم باعتمادهم أو إحالتهم للانتظار أو حذفهم.
                        </p>
                    </div>
                    @includeIf('pages.orphans.partials.auditing_addition_partial', ['orphans' => $orphans])

                @elseif ($from == 'sponsorship_page')
                    <div>
                        <h3 class="mb-1"> الأيتام المكفولون </h3>
                        <p style="color: rgba(36, 36, 36, 0.6);font-size:16px">
                            قائمة الأيتام الذين يتلقون كفالات مالية بشكل شهري، مع تفاصيل الكفالة وسجلات التسليمات.
                        </p>
                    </div>
                    @includeIf('pages.orphans.partials.sponsored_partial', ['orphans' => $orphans])

                @elseif ($from == 'adopted_page')
                    <div>
                        <h3 class="mb-1"> الأيتام المعتمدون </h3>
                        <p style="color: rgba(36, 36, 36, 0.6);font-size:16px">
                            هذه القائمة تحتوي على جميع الأيتام الذين تم اعتماد بياناتهم وهم مؤهلون للكفالة.
                        </p>
                    </div>
                    @includeIf('pages.orphans.partials.adopted_partial', ['orphans' => $orphans])

                @elseif ($from == 'waiting_page')
                    <div>
                        <h3 class="mb-1"> الأيتام قيد الانتظار </h3>
                        <p style="color: rgba(36, 36, 36, 0.6);font-size:16px">
                            أيتام بحاجة لاستكمال البيانات أو إعادة التدقيق قبل اعتمادهم.
                        </p>
                    </div>
                    @includeIf('pages.orphans.partials.waiting_partial', ['orphans' => $orphans])

                @endif

            </div>

        @endif

    </section>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const container = document.getElementById("conditions-container");
                const addBtn = document.getElementById("add-condition");

                const optionsData = {
                    cause_deceased_death: [
                        { value: "وفاة طبيعية", text: "وفاة طبيعية" },
                        { value: "شهيد", text: "شهيد" },
                    ],
                    health_status: [
                        { value: "سليم", text: "سليم" },
                        { value: "مريض", text: "مريض" },
                    ],
                    gender: [
                        { value: "ذكر", text: "ذكر" },
                        { value: "أنثى", text: "أنثى" },
                    ],
                    father_work: [
                        { value: "يعمل", text: "يعمل" },
                        { value: "لا يعمل", text: "لا يعمل" },
                    ],

                    nature_father_work: [
                        { value: "موظف حكومي", text: "موظف حكومي" },
                        { value: "موظف وكالة", text: "موظف وكالة" },
                        { value: "عمل خاص", text: "عمل خاص" },
                    ],
                    mother_status: [
                        { value: "على قيد الحياة- أرملة", text: "على قيد الحياة- أرملة" },
                        { value: "على قيد الحياة- متزوجة زوج آخر", text: "على قيد الحياة- متزوجة زوج آخر" },
                        { value: "على قيد الحياة- مطلقة", text: "على قيد الحياة- مطلقة" },
                        { value: "شهيدة/ متوفية", text: "شهيدة/ متوفية" },
                    ],
                    mother_work: [
                        { value: "تعمل", text: "تعمل" },
                        { value: "لا تعمل", text: "لا تعمل" },
                    ],
                    nature_mother_work: [
                        { value: "موظف حكومي", text: "موظفة حكومة" },
                        { value: "موظف وكالة", text: "موظفة وكالة" },
                        { value: "عمل خاص", text: "عمل خاص" },
                    ],
                    guardian_relation: [
                        { value: "أم", text: "أم" },
                        { value: "أخ/ت", text: "أخ/ت" },
                        { value: "جد/ة", text: "جد/ة" },
                        { value: "عم/ة", text: "عم/ة" },
                        { value: "خال/ة", text: "خال/ة" },
                        { value: "غير ذلك", text: "غير ذلك" },
                    ],

                };

                function createInput(type, name) {
                    const input = document.createElement("input");
                    input.type = type;
                    input.name = name;
                    input.className = "form-control";
                    return input;
                }

                function createSelect(options, name) {
                    const select = document.createElement("select");
                    select.name = name;
                    select.className = "form-select";

                    options.forEach(opt => {
                        const option = document.createElement("option");
                        option.value = opt.value;
                        option.textContent = opt.text;
                        select.appendChild(option);
                    });

                    return select;
                }

                function updateInputField(wrapper, key) {
                    wrapper.innerHTML = "";

                    // if (key === "orphan_sibling") {
                    //     wrapper.appendChild(createInput("number", "search_value[]"));
                    // } else

                    if (key === "birth_date" || key=== "death_deceased_date" || key=== "mother_birth_date") {
                        wrapper.appendChild(createInput("date", "search_value[]"));
                    } else if (optionsData[key]) {
                        wrapper.appendChild(createSelect(optionsData[key], "search_value[]"));
                    } else {
                        wrapper.appendChild(createInput("text", "search_value[]"));
                    }
                }

                // تحديث السطر الأول عند التحميل
                const firstSearchBy = container.querySelector(".search-by");
                const firstInputWrapper = container.querySelector(".search-input-wrapper");
                updateInputField(firstInputWrapper, firstSearchBy.value);
                firstSearchBy.addEventListener("change", function () {
                    updateInputField(firstInputWrapper, this.value);
                });

                addBtn.addEventListener("click", function () {
                    const row = document.createElement("div");
                    row.className = "d-flex align-items-center flex-wrap gap-3 mb-2 condition-row";

                    row.innerHTML = `
                        <div>
                            <select name="search_by[]" class="form-select search-by">
                                ${Object.keys(optionsData).map(key => `<option value="${key}">${key}</option>`).join('')}
                                <option value="name"> اسم اليتيم </option>
                                <option value="id_number"> رقم هوية اليتيم </option>
                                <option value="birth_date"> تاريخ ميلاد اليتيم </option>
                                <option value="orphan_code"> كود اليتيم </option>
                                <option value="address"> العنوان </option>
                                <option value="gender"> جنس اليتيم </option>
                                <option value="health_status"> الحالة الصحية لليتيم </option>
                                <option value="deceased_name"> اسم (الشهيد/ المتوفى) رباعي </option>
                                <option value="deceased_id_number"> رقم هوية (الشهيد/ المتوفى) </option>
                                <option value="death_deceased_date"> تاريخ (الإستشهاد/ الوفاة)  </option>
                                <option value="cause_deceased_death"> سبب الوفاة  </option>
                                <option value="father_work"> عمل الأب </option>
                                <option value="nature_father_work"> طبيعة عمل الأب </option>
                                <option value="nature_work"> طبيعة العمل </option>
                                <option value="mother_name"> اسم زوجة (الشهيد/ المتوفى) </option>
                                <option value="mother_id_number"> رقم هوية زوجة (الشهيد/ المتوفى) </option>
                                <option value="mother_birth_date"> تاريخ ميلاد الأم  </option>
                                <option value="mother_status"> حالة الأم </option>
                                <option value="mother_work"> عمل الأم </option>
                                <option value="nature_mother_work"> طبيعة عمل الأم </option>
                                <option value="guardian_name"> اسم الوكيل </option>
                                <option value="guardian_id_number"> رقم هوية الوكيل </option>
                                <option value="guardian_relation"> صلة القرابة الوكيل </option>
                                <option value="phone"> رقم جوال أساسي </option>
                                <option value="phone1"> رقم جوال ثانوي </option>
                                <option value="email"> البريد الالكتروني </option>

                            </select>
                        </div>

                        <div>
                            <select name="condition[]" class="form-select">
                                <option value="==">مطابق ل</option>
                            </select>
                        </div>

                        <div style="width:45%">
                            <div class="search-input-wrapper"></div>
                        </div>

                        <button type="button" class="btn btn-danger remove-condition">
                            <img src="{{asset('assets/icon/delete.png')}}" alt="">
                            <span> حذف </span>
                        </button>
                    `;

                    container.appendChild(row);

                    const select = row.querySelector(".search-by");
                    const wrapper = row.querySelector(".search-input-wrapper");
                    updateInputField(wrapper, select.value);

                    select.addEventListener("change", function () {
                        updateInputField(wrapper, this.value);
                    });

                    row.querySelector(".remove-condition").addEventListener("click", function () {
                        row.remove();
                    });
                });
            });
        </script>
    @endpush

    @if ($orphans)

        {{$orphans->withQueryString()->links()}}

    @endif
</x-main-layout>
