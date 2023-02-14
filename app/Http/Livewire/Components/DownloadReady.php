<?php

namespace App\Http\Livewire\Components;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadReady extends Component
{
    public $listeners = ['downloadReady' => 'onDownloadReady'];

    /**
     * @param $fileData array
     * @return StreamedResponse
     */
    public function onDownloadReady(array $fileData): StreamedResponse
    {
        return Storage::disk('admin_downloads')->download($fileData['path'], $fileData['name']);
    }

    public function render()
    {
        return view('livewire.components.download-ready');
    }
}
