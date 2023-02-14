<div class="block md:flex">
    <form class="flex {{$classes?? ''}}">
        <select wire:model="query" multiple
                style="width: {{ $width? $width : '200'}}px !important;"
                title="Select one or more"
                class="w-full p-2 rounded-md focus:bg-white focus:border-indigo-400 focus:outline-none"
        >
            @foreach ($this->options as $index => $option)
                <option value="{{ $option->id }}">{{ $option->name }}</option>
            @endforeach
        </select>
    </form>
    <div class="flex items-end md:ml-4 w-full md:w-[400px] md:max-w-[600px] md:mb-2">
        <div class="text-base mr-2 mt-2 md:mt-0">Selected:</div>
        <div class="mt-2 flex items-end justify-start w-full h-2/3 flex-wrap">
            @php
                $itemCount = 0;
            @endphp
            @foreach ($options as $option)
                @if (in_array($option->id, $query))
                    @php
                        $itemCount++;
                    @endphp

                    <div class="flex items-center justify-start h-8">
                        @if ($itemCount > 1)
                            <span class="p-1 inline-block">&</span>
                        @endif
                        <div
                            class="px-1 inline mr-1 text-sm bg-white font-normal text-accent-600 border-2 rounded border-accent-400 whitespace-nowrap">
                            {{ $option->name }}
                            <i wire:click="remove({{$option->id}})" title="remove"
                               class="cursor-pointer fa-regular fa-xmark text-accent-600 hover:text-accent-400 p-1 text-sm"></i>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
