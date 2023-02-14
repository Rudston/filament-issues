@if ($active)
<th class="text-sm text-left text-gray-900 font-medium pb-2 cursor-pointer pr-1"
    @if ($column == 'user_name') {
        @if($sorting && $sortOrder == 'DESC')
            title="Click to cancel sort"
        @elseif($sorting && $sortOrder == 'ASC')
            title="Click to sort descending last name, descending first name"
        @else
            title="Click to sort ascending last name, ascending first name"
        @endif
    @else
        @if($sorting && $sortOrder == 'DESC')
            title="Click to cancel sort"
        @elseif($sorting && $sortOrder == 'ASC')
            title="Click to change sort order"
        @else
            title="Click to sort ascending"
        @endif
    @endif
    wire:click="toggleSortOrder">
    @if($sorting && $sortOrder == 'DESC')
        <span class="inline-flex justify-left items-center w-full opacity-100" title="Descending">
            <i class="ml-4 fa-solid fa-sort-up font-black"></i>
        </span>
    @else
        <span class="inline-flex justify-left items-center w-full opacity-0">
            <i class="ml-4 fa-solid fa-sort-up"></i>
        </span>
    @endif

    <span class="block">{{ $label }}</span>

    @if($sorting  && $sortOrder == 'ASC')
        <span class="inline-flex justify-left items-center w-full opacity-100" title="Ascending">
            <i class="ml-4 fa-solid fa-sort-down font-black"></i>
        </span>
    @else
        <span class="inline-flex justify-left items-center w-full opacity-0">
            <i class="ml-4 fa-solid fa-sort-down"></i>
        </span>
    @endif
</th>
@else
    <th class="text-sm text-left text-gray-900 font-medium pb-2 cursor-not-allowed pr-1">
        <span class="block">{{ $label }}</span>
    </th>
@endif
