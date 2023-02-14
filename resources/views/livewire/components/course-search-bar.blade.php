<form class="flex relative {{ $classes?? ''}}">
    <input
        type="text"
        class="{{ $courseTitleSelected !== '' ? 'hidden' : '' }}  w-full border border-accent-600 focus:outline-none p-2 rounded-md focus:bg-white focus:border-accent-400 focus:outline-none"
        placeholder="Enter a course name or part thereof..."
        wire:model="query"
        wire:keydown.escape="resetVars"
        wire:keydown.tab="resetVars"
        wire:keydown.enter="selectContact"
        style="width: 502px !important;"
    />

    <input
        type="text"
        class="{{ $courseTitleSelected === '' ? 'hidden' : '' }}  w-full border border-accent-600 focus:outline-none p-2 rounded-md focus:bg-white focus:border-accent-400 focus:outline-none"
        wire:model="courseTitleSelected"
        wire:click="resetVars"
        wire:change="resetVars"
        style="width: 502px !important;"
    />
    @if(!empty($courseTitleSelected))
        <i id="clearCourse" wire:click="resetVars" title="clear"  class="cursor-pointer fa-regular fa-xmark text-accent-600 hover:text-accent-400 px-2 pb-2 pt-1 text-xl -ml-8"></i>
    @endif

    @if(!empty($query))
        <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="resetVars"></div>

        <div class="absolute z-10 w-full bg-white rounded-t-none shadow-lg" style="width: 502px !important;">
            @if(!empty($courses))
                @foreach($courses as $i => $course)
                    <span
                        class="hover:bg-accent-600 hover:text-white block"
                        wire:click="selectCourse('{{$course->course_title}}', '{{$course->course_group_id}}')"
                    >{{ $course->course_title }}
                        </span>
                @endforeach
            @else
                <div class="list-item">No results!</div>
            @endif
        </div>
    @endif
</form>
