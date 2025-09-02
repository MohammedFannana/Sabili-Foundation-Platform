<style>
  /* Hide action buttons by default */
  #actionButtons {
    display: none;
  }

  /* Show action buttons when the "show" class is added */
  #actionButtons.show {
    display: flex;
    gap: 0.5rem;
    align-items: center;
    flex-wrap: wrap;
  }
</style>

<div class="intro2 mb-3 flex-wrap gap-2 align-items-center" id="actionButtons">
    {{-- Sponsor Link --}}
    <form action="{{ route('orphans.action.sponsor') }}" method="post" id="sponsorForm" class="btn text-white" >
        @csrf
        <input type="hidden" name="ids" id="selectedSponsorIds" value="">

        <button class="btn text-white" type="submit" style="background-color: rgba(59, 207, 112, 1); padding:0.375rem 0.75rem; border-radius:0.25rem; display:inline-flex; align-items:center; cursor:pointer;">
            <img src="{{ asset('assets/icon/true.png') }}" alt="" class="mb-1" style="margin-right:5px;">
            <span> إحالة للكفالة </span>
        </button>
    </form>

    {{-- Delete Selected --}}
    <div>
        <button class="submit btn-delete btn btn-danger delete-selected">
            <img src="{{ asset('assets/icon/delete.png') }}" alt="" class="mb-1">
            <span> حذف المحدد </span>
        </button>
        <form id="deleteForm" action="{{ route('orphans.action.delete') }}" method="post" style="display:none">
            @csrf
            @method('delete')
            <input type="hidden" name="delete_ids" id="selectedDeleteIds">
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
                <th>العنوان</th>
                <th style="border-top-left-radius:15px">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orphans as $orphan)
                <tr>
                    <td>
                        <input type="checkbox" name="select_ids[]" class="orphan-checkbox" value="{{ $orphan->id }}">
                    </td>
                    <td>
                        <a href="{{ route('orphan.show', $orphan->id) }}" class="text-decoration-none">{{ $orphan->name }}</a>
                    </td>
                    <td>{{ $orphan->id_number }}</td>
                    <td>{{ $orphan->orphan_code }}</td>
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

                    <td>{{ $orphan->gender }}</td>
                    <td>{{ $orphan->address }}</td>
                    <td class="d-flex flex-wrap gap-1">
                        {{-- Single sponsor --}}
                        <form action="{{ route('orphans.action.sponsor') }}" method="post">
                            @csrf
                            <input type="hidden" name="ids" value="{{ $orphan->id }}">
                            <button type="submit" class="btn btn-outline-success">إحالة للكفالة</button>
                        </form>

                        {{-- Single delete --}}
                        <form action="{{ route('orphans.action.delete') }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="delete_ids" value="{{ $orphan->id }}">
                            <button type="submit" class="btn btn-outline-danger">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <td colspan="8" class="fs-4 text-center" style="color: var(--primary-color)">
                    لا يوجد أيتام معتمدين مسجلين في النظام
                </td>
            @endforelse
        </tbody>
    </table>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sponsorForm = document.getElementById('sponsorForm');
        const checkboxes = document.querySelectorAll('.orphan-checkbox');
        const deleteInput = document.getElementById('selectedDeleteIds');
        const deleteBtn = document.querySelector('.delete-selected');
        const actionButtons = document.getElementById('actionButtons');
        const selectedSponsorIds = document.getElementById('selectedSponsorIds');

        function updateSelectedIds() {
            const selected = Array.from(checkboxes).filter(cb => cb.checked).map(cb => cb.value);

            // Show/hide action buttons based on selection
            if (selected.length > 0) {
                actionButtons.classList.add('show');
            } else {
                actionButtons.classList.remove('show');
            }

            // Update hidden delete input value
            if (deleteInput) {
                deleteInput.value = selected.join(',');
            }
        }

        // Attach change event to all checkboxes
        checkboxes.forEach(cb => cb.addEventListener('change', updateSelectedIds));
        updateSelectedIds();

        // Submit form only if IDs selected
        sponsorForm.addEventListener('submit', function(e) {
            const selected = Array.from(checkboxes).filter(cb => cb.checked).map(cb => cb.value);
            if (selected.length === 0) {
                e.preventDefault();
                alert('يرجى اختيار يتيم واحد على الأقل');
                return false;
            }
            selectedSponsorIds.value = selected.join(',');
        });

        // Handle delete selected
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function() {
                if (confirm('هل أنت متأكد من حذف المحدد؟')) {
                    const deleteForm = document.getElementById('deleteForm');
                    if (deleteForm) deleteForm.submit();
                }
            });
        }
    });
</script>
@endpush
