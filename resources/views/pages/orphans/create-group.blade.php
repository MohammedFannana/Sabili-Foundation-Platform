<x-main-layout title="مؤسسة سبيلي الخيرية">

    <section class="mt-1">

        <x-alert name="success" />
        <x-alert name="danger" />



        {{-- section header component --}}
        <h3 class="mb-5"> إضافة يتيم </h3>

        <div class="mb-4 rounded p-2 pt-2 pb-2 row ms-1 me-1" style="background-color:#f8fafa;">
            <a href="{{route('orphan.create')}}" class="col-12 col-sm-6 text-center fw-semibold text-decoration-none p-2 rounded" style="color: rgba(36, 36, 36, 0.6)"> الإضافة يدويًا بشكل فردي </a>
            <a href="{{route('orphan.group.create')}}" class="col-12 col-sm-6 text-center fw-semibold text-decoration-none p-2 rounded" style="color: var(--primary-color); background-color:var(--third-color)" > استيراد جماعي </a>
        </div>

        <div>
            <p class="fw-semibold mb-4">يمكنك استيراد عدة أيتام دفعة واحدة من خلال:</p>



            <div class="d-flex">

                <div class="col-12 col-sm-6 col-lg-3 mb-4">

                    <form action="{{ route('orphan.uplode.excel') }}" id="excel-form" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="orphan_excel_file" class="custom-file-upload text-center p-2 ps-3 pe-3 w-100"
                            style="color:white;background-color:var(--primary-color); border:1px solid var(--primary-color)">
                            <img src="{{ asset('assets/icon/excel.png') }}" alt="">
                            استيراد ملف Excel
                        </label>
                        <x-form.input name="orphan_excel_file" class="hidden-file-style" type="file" id="orphan_excel_file" style="display: none;" accept=".xlsx,.xls,.csv"/>
                    </form>

                </div>

                {{-- <div class="col-12 col-sm-6 col-lg-3 mb-4">
                    <form action="{{ route('orphan.uplode.access') }}"  id="access-form"  method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="orphan_access_file" class="custom-file-upload text-center p-2 ps-3 pe-3 w-100"
                            style="color:var(--primary-color); border:1px solid var(--primary-color)">
                            <img src="{{ asset('assets/icon/Access.png') }}" alt="">
                            استيراد ملف Access
                        </label>
                        <x-form.input name="orphan_access_file"
                                    class="hidden-file-style"
                                    type="file"
                                    id="orphan_access_file"
                                    style="display: none;" accept=".accdb,.mdb"/>
                    </form>
                </div> --}}

            </div>

            <div id="uploading-message" style="display:none; text-align:center; padding:2px; color:white; background: var(--primary-color); border-radius: 5px;">
                <p>جاري رفع الملف... يرجى الانتظار</p>
            </div>


        </div>

    </section>

    @push('scripts')

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let uploading = false;

                const uploadingMessage = document.getElementById('uploading-message');
                const excelInput = document.getElementById('orphan_excel_file');
                // const accessInput = document.getElementById('orphan_access_file');
                const excelForm = document.getElementById('excel-form');
                //const accessForm = document.getElementById('access-form');

                function handleFileUpload(inputElement, formElement) {
                    if (uploading) {
                        alert('يرجى الانتظار حتى يكتمل رفع الملف الحالي.');
                        inputElement.value = ""; // reset the input
                        return;
                    }

                    if (!inputElement.files.length) return;

                    uploading = true;
                    uploadingMessage.style.display = 'block';

                    // لا تقم بتعطيل الحقول قبل الإرسال!

                    // إرسال النموذج
                    formElement.submit();
                }

                excelInput.addEventListener('change', function () {
                    handleFileUpload(excelInput, excelForm);
                });

                // accessInput.addEventListener('change', function () {
                //     handleFileUpload(accessInput, accessForm);
                // });
            });

        </script>

    @endpush
</x-main-layout>
