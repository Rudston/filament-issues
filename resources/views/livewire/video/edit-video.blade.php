<div class="flex-col justify-center items-center min-h-screen w-full p-10 md:w-2/3 lg:w-1/2 pt-8 mx-auto relative">

    <form wire:submit.prevent="save" id="form">
        {{ $this->form }}
        <div class="flex justify-between">
            <button type="submit" id="save-button"
                    class="mt-4 cursor-pointer inline-block font-semibold px-2 py-2 text-center text-white text-base rounded bg-accent-600 hover:bg-accent-400">
                Save Video
            </button>
            <button type="button"
                    class="mt-4 cursor-pointer inline-block font-semibold px-2 py-2 text-center text-white text-base rounded bg-accent-600 hover:bg-accent-400"
                    onclick="window.location.href='{{ $this->viewUrl }}'; return false;"
            >View
            </button>
        </div>

    </form>
</div>
