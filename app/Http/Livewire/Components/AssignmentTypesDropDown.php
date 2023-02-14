<?php

namespace App\Http\Livewire\Components;

use App\Models\Student\StudentAssessmentRecord;
use Livewire\Component;

class AssignmentTypesDropDown extends Component
{
    public $assignmentTypes;

    public $assignmentTypeSelected;

    const ALL_TYPES = 'All';

    protected $listeners = ['searchCleared' => 'onSearchCleared'];

    public function onSearchCleared() {
        $this->assignmentTypeSelected = null;
    }

    public function mount()
    {
        $this->assignmentTypes = [
            self::ALL_TYPES => self::ALL_TYPES,
            'Formative' => 'Formative',
            'Summative' => 'Summative'
        ];
    }

    public function render()
    {
        return view('livewire.components.assignment-types-drop-down');
    }

    public function updatedAssignmentTypeSelected()
    {
        if ($this->assignmentTypeSelected !== self::ALL_TYPES) {
            $this->emit('assignmentTypeSelected', $this->assignmentTypeSelected);
        } else {
            $this->emit('assignmentTypeSelected', null);
        }
    }
}
