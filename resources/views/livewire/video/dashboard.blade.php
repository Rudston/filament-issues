<div class="min-h-screen px-6 py-4 bg-gray-50 text-gray-900 relative">
    {{--    <div class="container mx-auto">--}}

    <x-loading/>

    {{--    Desktop and Tablet--}}
    <div class="hidden md:block w-full md:w-7/8 mx-auto h-screen">
        <div class="pt-4 pb-2 w-full flex justify-start items-center">
            <div class="text-base w-36 min-w-36 text-right pr-2">Search:</div>
            <livewire:components.generic-text-search-bar :classes="'mr-4'"
                                                         :item-queried="'allTexts'"
                                                         :placeholder="'Titles and descriptions'"/>

            <span class="ml-3 text-base w-28 text-right pr-2">Date:</span>
            <livewire:components.date-search :which-date="'date_from'"
                                             :placeholder="'from'"
                                             :classes="'mr-6'"
                                             :ident="'date_from_desktop'"/>
            <livewire:components.date-search :which-date="'date_to'"
                                             :placeholder="'to'"
                                             :classes="''"
                                             :ident="'date_to_desktop'"/>
        </div>

        <div class="pt-4 pb-2 w-full flex justify-start items-center">
            <div class="text-base w-36 min-w-36 text-right pr-2">Filter by Tags:</div>
            <livewire:components.generic-multi-select-filter
                :item-queried="'tags'"
                :options="$videoTags"
                :width="250"
            />


        </div>

        <div class="pt-4 pb-2 w-full flex justify-start items-center">
            <div class="text-base w-36 text-right pr-2">&nbsp;</div>
            @if($this->clearSearchEnabled)
                <button wire:click="clearSearch(true)"
                        class="cursor-pointer inline-block font-medium px-3 py-2 text-center text-white text-base rounded bg-accent-600 hover:bg-accent-400">
                    Clear All Search Criteria
                </button>
            @else
                <button wire:click="clearSearch(false)"
                        class="cursor-not-allowed inline-block font-medium px-3 py-2 text-center text-white text-base rounded bg-accent-400 ">
                    Clear All Search Criteria
                </button>
            @endif
            @if ($isAdminUser === true)
                <button wire:click="$emit('openModal', 'video.manage-video-tags-modal')"
                        class="ml-32 cursor-pointer inline-block font-medium px-2 py-2 text-center text-white text-base rounded bg-accent-600 hover:bg-accent-400">
                    Manage Video Tags
                </button>
            @endif
        </div>
        <div class="my-4 ml-36 w-2/3">
            {{ $videos->links('vendor.pagination.tailwind-customised') }}
            @if ($videos->total() < 50)
                @if ($videos->total() == 1)
                    1 video found
                @else
                    {{ $videos->total() }} videos found
                @endif
            @endif
        </div>
        <div class="hidden md:block w-full mt-6 overflow-x-scroll p-3 bg-white rounded-md border border-accent-600">
            <table class="table-auto w-full">
                <tr class="border-b border-accent-600">
                    @foreach ($columns as $column)
                        <livewire:components.sortable-column-header
                            :deactivated="in_array($column, $columnsWithSortDeactivated)"
                            :label="$tableHeaders[$column]"
                            :column="$column" :key="$column"/>
                    @endforeach
                </tr>
                @if (count($videos))
                    @foreach($videos as $video)
                        @if ($loop->last)
                            <x-admin.video :columns="$columns" :video="$video" :last="true" :admin="$isAdminUser"/>
                        @else
                            <x-admin.video :columns="$columns" :video="$video" :last="false" :admin="$isAdminUser"/>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td colspan="{{ count($columns) }}" class="text-base text-left py-4">No videos found
                        </td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
    {{-- END   Desktop and Tablet--}}
    {{-- MOBILE --}}
    <div class="block md:hidden w-full">
        <div class="pt-2 pb-2 w-full flex-col justify-start items-center">
            <div class="text-base text-left py-1">Search:</div>
            <livewire:components.generic-text-search-bar :classes="'mr-4'"
                                                         :item-queried="'allTexts'"
                                                         :placeholder="'Titles and descriptions'"/>
            <span class="text-base w-36 text-right pr-2">Date:</span>
            <livewire:components.date-search :which-date="'date_from'"
                                             :placeholder="'from'"
                                             :classes="'mr-6'"
                                             :ident="'date_from_mobile'"/>
            <livewire:components.date-search :which-date="'date_to'"
                                             :placeholder="'to'"
                                             :classes="''"
                                             :ident="'date_to_mobile'"/>
        </div>
        <div class="pt-2 pb-2 w-full flex-col justify-start items-center">
            <div class="text-base text-left py-1">Filter by Tags:</div>
            <livewire:components.generic-multi-select-filter
                :item-queried="'tags'"
                :options="$videoTags"
                :width="250"
                :placeholder="'Select one or more'"/>
        </div>
        <div class="flex justify-between py-4">
            @if($this->clearSearchEnabled)
                <button wire:click="clearSearch(true)"
                        class="cursor-pointer inline-block font-medium px-2 py-2 text-center text-white text-base rounded bg-accent-600 hover:bg-accent-400">
                    Clear Search
                </button>
            @else
                <button wire:click="clearSearch(false)"
                        class="cursor-not-allowed inline-block font-medium px-2 py-2 text-center text-white text-base rounded bg-accent-400 ">
                    Clear Search
                </button>
            @endif
        </div>
        @if ($isAdminUser === true)
            <div class="flex justify-between py-4">
                <button wire:click="$emit('openModal', 'video.manage-video-tags-modal')"
                        class="cursor-pointer inline-block font-medium px-2 py-2 text-center text-white text-base rounded bg-accent-600 hover:bg-accent-400">
                    Manage Video Tags
                </button>
            </div>
        @endif
        <div class="pt-2 w-full">
            {{ $videos->links('vendor.pagination.tailwind-customised') }}
            @if ($videos->total() < 50)
                @if ($videos->total() == 1)
                    1 video found
                @else
                    {{ $videos->total() }} videos found
                @endif
            @endif
        </div>
    </div>

    <div class="block md:hidden w-full mt-6 overflow-x-scroll p-3 bg-white rounded-md border border-accent-600">
        <div class="w-full">
            @if (count($videos))
                @foreach($videos as $video)
                    @if ($loop->last)
                        <x-admin.video-vertical :table-headers="$tableHeaders" :columns="$columns"
                                                :video="$video" :last="true" :admin="$isAdminUser"/>
                    @else
                        <x-admin.video-vertical :table-headers="$tableHeaders" :columns="$columns"
                                                :video="$video" :last="false" :admin="$isAdminUser"/>
                    @endif
                @endforeach
            @else
                <div class="text-base text-left py-4">No videos found</div>
            @endif
        </div>
        {{--        </div>--}}
    </div>

    @stack('scripts')
</div>
