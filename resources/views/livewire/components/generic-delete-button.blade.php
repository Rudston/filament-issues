<div>
    <button
        onclick="confirm('{{ $message }}')? @this.deleteEntity({{$entityId}}): false;"
        type="button"
        class="inline-block font-normal px-2 py-2 text-center text-white text-xs md:text-small rounded bg-accent-600 hover:bg-accent-400">
        {{ $buttonText }}
    </button>
</div>
