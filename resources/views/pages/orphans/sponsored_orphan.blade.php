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


    <x-alert name="success" />
    <x-alert name="danger" />

    {{-- section header component --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h3 class="mb-1"> الأيتام المكفولون </h3>
            <p style="color: rgba(36, 36, 36, 0.6);font-size:16px">
                قائمة الأيتام الذين يتلقون كفالات مالية بشكل شهري، مع تفاصيل الكفالة وسجلات التسليمات.
            </p>
        </div>

        <form action="{{route('orphans.action.search')}}" method="post" >
            @csrf
            <input type="hidden" name="from" value="sponsorship_page">
            <button type="submit" class="submit-btn text-decoration-none rounded"  style="padding-right:60px;padding-left:60px"> إنشاء استعلام </button>
        </form>

    </div>


    @includeIf('pages.orphans.partials.sponsored_partial' , ['orphans' => $orphans])


    {{$orphans->withQueryString()->links()}}

</x-main-layout>

