<div>
    <select name="status" id="status" class="border border-accent-600 focus:outline-none p-2 rounded-md focus:bg-white focus:border-accent-400 focus:outline-none"
            style="width: 172px !important;" wire:model="assignmentTypeSelected"
    >
        @foreach($assignmentTypes as $type)
            <option value="{{ $type }}">{{ $type }}</option>
        @endforeach
    </select>
</div>


