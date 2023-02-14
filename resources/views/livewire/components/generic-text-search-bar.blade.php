<form class="relative flex {{$classes?? ''}}">
    <input
        type="text"
        placeholder="{{ $placeholder }}"
        wire:model="query"
        style="width: {{ $width? $width : '200'}}px !important;"
        wire:keydown.escape="resetVars"
        wire:keydown.tab="resetVars"
        wire:click="resetVars"
        class="w-full p-2 rounded-md focus:bg-white focus:border-indigo-400 focus:outline-none"
    />
    @if(!empty($query))
        <i id="clear_{{ $ident }}" wire:click="resetVars" title="clear"  class="cursor-pointer fa-regular fa-xmark text-accent-600 hover:text-accent-400 px-2 pb-2 pt-1 text-xl -ml-8"></i>
    @endif
</form>
