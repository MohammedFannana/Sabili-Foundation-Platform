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
            <h3 class="mb-1"> تدقيق طلبات الإضافة </h3>
            <p style="color: rgba(36, 36, 36, 0.6);font-size:16px">
                راجع بيانات الأيتام المضافة حديثًا، ثم قم باعتمادهم أو إحالتهم للانتظار أو حذفهم.
            </p>
        </div>

        <form action="{{route('orphans.action.search')}}" method="post" >
            @csrf
            <input type="hidden" name="from" value="auditing_addition_page">
            <button type="submit" class="submit-btn text-decoration-none rounded"  style="padding-right:60px;padding-left:60px"> إنشاء استعلام </button>
        </form>

    </div>

    @includeIf('pages.orphans.partials.auditing_addition_partial' , ['orphans' => $orphans])


    {{$orphans->withQueryString()->links()}}
</x-main-layout>
