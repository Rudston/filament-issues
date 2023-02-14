@props(['columns', 'video', 'last', 'admin'])
<tr class=" {{ $last === false ? 'border-b border-accent-400': '' }}">
    @foreach($columns as $column)
        @if ($column === 'edit')
            @if ($admin)
                <td class="text-xs text-left pr-1 py-2">
                    <livewire:components.generic-edit-button
                        :button-text="'Edit'"
                        :route="$video->getColumn($column)"
                        :wire:key="$video->id.'-edit-'.now()"
                    />
                </td>
            @endif
        @elseif ($column === 'delete')

            @if ($admin)
                <td class="text-xs text-left pr-1 py-2">
                    <livewire:components.generic-delete-button
                        :message="'Do you really want to delete this video?'"
                        :button-text="'Delete'"
                        :entity-id="$video->id"
                        :entity-class="'App\Models\Assets\Video'"
                        :wire:key="$video->id.'-delete-'.now()"
                    />
                </td>
            @endif
        @elseif ($column === 'view')
            <td class="text-xs text-left pr-1 py-2">
                <button type="button"
                        class="inline-block font-normal px-2 py-2 text-center text-white text-xs md:text-small rounded bg-accent-600 hover:bg-accent-400"
                        onclick="window.open(`{!! $video->getColumn($column) !!}`, '_blank'); return false;"
                >View
                </button>
            </td>
        @elseif ($column == 'tags')
            <td class="text-xs font-semibold text-left pr-1 py-2 whitespace-nowrap">{!! $video->getColumn($column) !!}</td>
        @else
            <td class="text-base text-left pr-1 py-2 whitespace-nowrap">{!! $video->getColumn($column) !!}</td>
        @endif
    @endforeach
</tr>
