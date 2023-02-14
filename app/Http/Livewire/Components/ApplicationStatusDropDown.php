<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class ApplicationStatusDropDown extends Component
{
    public $statuses = null;

    public $applicationStatusSelected;

    const ALL_STATUSES = 'All Statuses';

    protected $listeners = ['searchCleared' => 'onSearchCleared'];

    public function onSearchCleared() {
        $this->applicationStatusSelected = null;
    }

    public function mount()
    {
        $statuses[] = ['text' => 'All Statuses', 'value' => self::ALL_STATUSES];
        $statuses[] = ['text' => 'Accepted', 'value' => 1];
        $statuses[] = ['text' => 'Accepted Conditionally', 'value' => 2];
        $statuses[] = ['text' => 'Declined', 'value' => 99];
        $statuses[] = ['text' => 'Deferred', 'value' => 3];
        $statuses[] = ['text' => 'Pending', 'value' => -1];

        $this->statuses = $statuses;
    }

    public function render()
    {
        return view('livewire.components.application-status-drop-down');
    }

    public function updatedApplicationStatusSelected()
    {
        if ($this->applicationStatusSelected !== self::ALL_STATUSES) {
            $this->emit('applicationStatusSelected', $this->applicationStatusSelected);
        } else {
            $this->emit('applicationStatusSelected', null);
        }
    }
}
