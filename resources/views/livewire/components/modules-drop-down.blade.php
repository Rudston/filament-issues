<div>
    <select name="status" id="status" class="w-full border border-accent-600 focus:outline-none p-2 rounded-md focus:bg-white focus:border-accent-400 focus:outline-none"
            style="width: 185px !important;" wire:model="moduleSelected"
    >
        @foreach($modules as $module)
            <option value="{{ $module }}">{{ $module }}</option>
        @endforeach
    </select>
</div>


