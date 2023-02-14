<?php

/**
 * NOTE use of   key="delete-tutor-{{ now() }}"
 * Using wire keys that will be the same the next time a row is rendered causes issues - same component is repeated ...
 */

namespace App\Http\Livewire\Components;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

use App\Models\Tutors\TutorRecord;

class GenericDeleteButton extends Component
{
    public $message;
    public $buttonText;
    public $entityId;
    public $entityClass;

    public function mount(string $message, int $entityId, string $entityClass, string $buttonText)
    {
        $this->message = $message;
        $this->entityId = $entityId;
        $this->buttonText = $buttonText;
        $this->entityClass = $entityClass;
    }

    public function render()
    {
        return view('livewire.components.generic-delete-button');
    }

    public function deleteEntity(int $id)
    {
        $entity = $this->entityClass::where('id', '=', $id)->first();
        $entity->delete();
        $this->emit('rowDeleted');
    }

}
