<div>
    <select name="applicationStatus" id="applicationStatus" class="w-full border border-accent-600 focus:outline-none p-2 rounded-md focus:bg-white focus:border-accent-400 focus:outline-none"
            style="width: 210px !important;" wire:model="applicationStatusSelected"
    >
        @foreach($statuses as $status)
            <option value="{{ $status['value'] }}">{{ $status['text'] }}</option>
        @endforeach
    </select>
</div>
