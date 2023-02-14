<div class="{{$classes?? ''}}">
    <select name="{{ $itemToFilter."Select" }}" id="{{ $itemToFilter."Select" }}" class="w-full border border-accent-600 focus:outline-none p-2 rounded-md focus:bg-white focus:border-accent-400 focus:outline-none"
            style="width: {{ $width?? 200 }}px !important;" wire:model="optionSelected"
    >
        @foreach($options as $option)
            <option value="{{ $option['value'] }}" >{{ $option['text'] }}</option>
        @endforeach
    </select>
</div>
