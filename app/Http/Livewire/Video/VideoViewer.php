<?php

namespace App\Http\Livewire\Video;

use App\Models\Assets\Video;
use Livewire\Component;

class VideoViewer extends Component
{
    public Video $video;
    public $editUrl;
    public $isAdminUser;

    public function mount()
    {
        $this->isAdminUser = true;
        $this->editUrl = route('edit.video',['video' => $this->video->id]);
    }

    public function render()
    {
        return view('livewire.video.video-viewer')
            ->layout('layouts.admin.livewire-focus', ['title' => 'Videos > View > Video']);
    }
}
