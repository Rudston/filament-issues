<div class="h-3/4 px-6 pt-2 pb-4 text-gray-900 rounded-lg border-2 border-accent-600">
    <div class="w-full h-full bg-white">
        <div class="flex justify-between w-full text-xl py-4 text-left pl-1">
            <span>Manage Video Tags</span>
            <button wire:click="$emit('closeModal')"
                    class="cursor-pointer inline-block font-medium px-2 py-2 text-center text-white text-sm rounded bg-accent-600 hover:bg-accent-400"
            >Close
            </button>
        </div>

        <div class="pt-4 pb-2 w-full flex justify-start items-center">
            <div class="text-base pr-2">Search:</div>
            <livewire:components.generic-text-search-bar :classes="''"
                                                         :item-queried="'texts'"
                                                         :placeholder="'names and notes'"/>
        </div>

        <div class="pt-2 w-full">
            {{ $tags->links('vendor.pagination.tailwind-customised') }}
            @if ($tags->total() < 50)
                @if ($tags->total() == 1)
                    1 tag found
                @else
                    {{ $tags->total() }} tags found
                @endif
            @endif
        </div>

        <div
            class="flex justify-start w-full mt-4 overflow-y-scroll px-1 max-h-[250px]  bg-white border border-accent-600">
            <div class="w-full">
                @if (count($tags))
                    @foreach($tags as $tag)
                        <div
                            class="{{ !$loop->last ? 'border-b-2 border-gray-400' : ''  }} py-1 pl-1 flex justify-between items-center">
                            <span class="text-sm">{{ $tag->name}}</span>
                            <div class="flex justify-between items-center">
                                <button
                                    wire:click="editTag({{ $tag }})"
                                    type="button"
                                    class="inline-block font-normal px-2 py-2 text-center text-white text-xs md:text-small rounded bg-accent-600 hover:bg-accent-400 mr-2">
                                    Edit
                                </button>
                                <livewire:components.generic-delete-button
                                    :message="'Do you really want to delete this tag?'"
                                    :button-text="'Delete'"
                                    :entity-id="$tag->id"
                                    :entity-class="'App\Models\Assets\VideoTag'"
                                    :wire:key="$tag->id.'-delete-'.now()"
                                />
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-base text-left py-4">No videos found</div>
                @endif
            </div>
        </div>

        <div class="mt-2 px-1">
            @if($this->tagIdEditing)
                <div class="w-full py-2 text-base">Edit Tag</div>
            @else
                <div class="w-full py-2 text-base">New Tag</div>
            @endif
            <form wire:submit.prevent="save">
                {{ $this->form }}
                <div class="flex justify-end mt-2">
                    <button type="submit"
                            class="cursor-pointer inline-block font-medium px-2 py-2 text-center text-white text-sm rounded bg-accent-600 hover:bg-accent-400 pt-2"
                    >
                        @if($this->tagIdEditing)
                            Update
                        @else
                            Save
                        @endif
                    </button>

                    @if($this->tagIdEditing)
                        <button type="button" wire:click="cancelEdit"
                                class="ml-2 cursor-pointer inline-block font-medium px-2 py-2 text-center text-white text-sm rounded bg-accent-600 hover:bg-accent-400 pt-2"
                        >
                            Cancel
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
