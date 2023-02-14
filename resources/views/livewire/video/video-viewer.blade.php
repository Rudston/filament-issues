<div class="min-h-screen px-6 py-4 bg-gray-50 text-gray-900 relative">
    <div class="container mx-auto">
        <div class="w-[320px] md:w-[640px] mx-auto">
            <div class="flex justify start text-xl py-4 text-accent-600 font-semibold">
                <div>{{ $this->video->date }}</div>
                <div>{{ $this->video->title }}</div>
            </div>
            <div class="w-full py-2">
                @foreach ($this->video->tags as $tag)
                    <span
                        class="text-base bg-white font-normal text-accent-600 p-1 border-2 rounded border-accent-400  mr-2">{{ $tag->name }}</span>
                @endforeach
            </div>
            <div class="w-full text-base py-2 mt-2">
                {{ $this->video->description }}
            </div>
        </div>
        @if ($this->video->vimeo_url)
            <div class="hidden md:block w-[640px] mx-auto my-4">
                <iframe src="{{ $this->video->vimeo_url }}" width="640" height="360" frameborder="0"
                        allow="autoplay; fullscreen; picture-in-picture" allowfullscreen
                        title="{{ $this->video->title }}">
                </iframe>
            </div>
            <div class="block md:hidden w-[320px] mx-auto my-4">
                <iframe src="{{ $this->video->vimeo_url }}" width="320" height="180" frameborder="0"
                        allow="autoplay; fullscreen; picture-in-picture" allowfullscreen
                        title="{{ $this->video->title }}">
                </iframe>
            </div>
        @else
            <div class="text-center font-bold text-base">No video url available</div>
        @endif
        <div class="w-[320px] md:w-[640px] mx-auto flex justify-between mt-4">
            @if ($this->video->chat_url)
                <a class="block" href="{{ $this->video->chat_url }}">
                    <span class="c2 underline">DOWNLOAD CHAT TEXT</span>
                </a>
            @else
                <div class="text-center font-bold text-base">No chat url available</div>
            @endif

            @if($isAdminUser)
                <button type="button"
                        class="inline-block font-normal px-2 py-2 text-center text-white text-base md:text-small rounded bg-accent-600 hover:bg-accent-400"
                        onclick="window.location.href='{{ $this->editUrl }}'; return false;"
                >Edit
                </button>
            @endif
        </div>
    </div>
</div>
