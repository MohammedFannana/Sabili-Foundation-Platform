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
        <div style="margin-right:1rem;margin-left:1rem">

            <form action="{{route('orphans.financial.documents.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="d-flex flex-column">
                    <div class="col-12 col-md-6 mb-4">
                        <label class="mb-2 fw-bold"> المستند المالي
                            <span class="text-danger">*</span>
                        </label> <br>
                        <label for="file" class="custom-file-upload text-center w-100" style="color:#777a78;">
                            <img src="{{asset('assets/images/file.png')}}" alt="" width="50px" height="50px"> <br>
                            اسحب الملف هنا أو اضغط لاختياره
                        </label>
                        <x-form.input name="file" class="hidden-file-style" type="file" id="file" style="display: none;"/>
                    </div>


                    <div class="d-flex flex-wrap gap-2">
                        <div class="col-6">
                            <x-form.input name="date" class="w-100 form-control" type="month" id="date" required="required" placeholder=" ادخل شهر المستد المالي " />
                        </div>
                        <button type="submit" class="submit-btn"> حفظ المستند </button>
                    </div>


                </div>



            </form>

            <div class="row justify-content-between mb-4">

                <h3 class="mb-1 mt-3"> المستندات المالية </h3>

                @if ($files->isNotEmpty())

                    <form action="{{route('orphans.financial.documents.index')}}" class="mb-4" method="GET" enctype="multipart/form-data">

                        <div class="d-flex row justify-content-between flex-wrap align-items-center">

                            <div class="col-12 col-sm-10">
                                <x-form.input name="date" class="w-100 form-control" type="month" value="{{ old('date', request('date')) }}"  label=" تاريخ المستند " placeholder="ادخل تاريخ المستند " />

                            </div>

                            <div class="col-2" style="margin-top: 1.9rem">
                                <button type="submit" class="submit-btn ps-5 pe-5"> بحث </button>
                            </div>

                        </div>

                    </form>

                @endif

                @forelse ($files as $file)

                    <div class="col-12 col-md-4 rounded d-flex  gap-5 align-items-center p-2" style="background-color: var(--third-color);width:32%">

                        <div class="d-flex align-items-center gap-3">
                            <div class="p-2 rounded">
                                <img src="{{asset('assets/icon/Access.png')}}" alt="" width="30px">
                            </div>

                            <div>
                                <p class="fw-bold fs-4 mb-1" style="color: var(--primary-color)"></p>
                                <p>
                                    <strong class="fs-5"> مستند مالي </strong>  <br>
                                    <span> {{ \Carbon\Carbon::parse($file->date)->format('m-Y') }} </span>
                                </p>
                            </div>
                        </div>

                        <a href="{{route('orphans.financial.documents.download' , $file->id)}}" class="btn btn-outline-primary"> تنزيل </a>

                    </div>

                @empty

                    <div class="col-12 text-white text-center rounded p-2" style="background-color: var(--primary-color)"> لا يوجد مستندات مالية لعرضها </div>

                @endforelse




            </div>

        </div>

    </section>

{{$files->withQueryString()->links()}}
</x-main-layout>
