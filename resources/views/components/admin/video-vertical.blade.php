@props(['tableHeaders', 'columns', 'video', 'last', 'admin'])
<div class="flex-col justify-between items-center py-2 {{ $last === false ? 'border-b border-accent-400': '' }}">
    @foreach($columns as $column)
        @if ($column === 'description')
            <div class="block text-xs text-left py-1 items-center">
                <div class="font-bold pb-1">{{ $tableHeaders[$column] }}</div>
                <div class="">{!! $video->getColumn($column, true) !!}</div>
            </div>
        @elseif ($column === 'edit')
            @if ($admin)
                <div class="inline-block pr-4 py-2">
                    <livewire:components.generic-edit-button
                        :button-text="'Edit'"
                        :route="$video->getColumn($column)"
                        :wire:key="$video->id.'-edit-mobile-'.now()"
                    />
                </div>
            @endif
        @elseif ($column === 'delete')
            @if ($admin)
                <div class="inline-block pr-4 py-2">
                    <livewire:components.generic-delete-button
                        :message="'Do you really want to delete this video?'"
                        :button-text="'Delete'"
                        :entity-id="$video->id"
                        :entity-class="'App\Models\Assets\Video'"
                        :wire:key="$video->id.'-delete-mobile-'.now()"
                    />
                </div>
            @endif
        @elseif ($column === 'view')
            <div class="inline-block pr-4 py-2">
                <button type="button"
                        class="inline-block font-normal px-2 py-2 text-center text-white text-xs md:text-small rounded bg-accent-600 hover:bg-accent-400"
                        onclick="window.open(`{!! $video->getColumn($column) !!}`, '_blank'); return false;"
                >View
                </button>
            </div>
        @else
            <div class="flex justify-between text-xs text-left py-1 items-center">
                <div class="font-bold">{{ $tableHeaders[$column] }}</div>
                <div class="pr-2">{!! $video->getColumn($column, true) !!}</div>
            </div>
        @endif
    @endforeach
</div>
