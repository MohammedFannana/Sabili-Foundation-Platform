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
        </style>

    @endpush



    <x-alert name="success" />
    <x-alert name="danger" />

    {{-- section header component --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h3 class="mb-1"> الأيتام قيد الانتظار </h3>
            <p style="color: rgba(36, 36, 36, 0.6);font-size:16px">
                أيتام بحاجة لاستكمال البيانات أو إعادة التدقيق قبل اعتمادهم.
            </p>
        </div>

        <form action="{{route('orphans.action.search')}}" method="post" >
            @csrf
            <input type="hidden" name="from" value="waiting_page">
            <button type="submit" class="submit-btn text-decoration-none rounded"  style="padding-right:60px;padding-left:60px"> إنشاء استعلام </button>
        </form>

    </div>

    @includeIf('pages.orphans.partials.waiting_partial' , ['orphans' => $orphans])

    {{$orphans->withQueryString()->links()}}
</x-main-layout>

