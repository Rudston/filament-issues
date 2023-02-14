<?php

namespace App\Http\Livewire\Components;

use App\Models\Student\StudentAssessmentRecord;
use Livewire\Component;

class ModulesDropDown extends Component
{
    public $modules = null;

    public $moduleSelected;

    const ALL_MODULES = 'All Modules';

    protected $listeners = ['searchCleared' => 'onSearchCleared'];

    public function onSearchCleared() {
        $this->moduleSelected = null;
    }

    public function mount()
    {
        $modules = StudentAssessmentRecord::groupBy('module')->pluck('module')->prepend(self::ALL_MODULES);
        $this->modules = $modules->map(function ($module) {
            return trim($module);
        });
    }

    public function render()
    {
        return view('livewire.components.modules-drop-down');
    }

    public function updatedModuleSelected()
    {
        if ($this->moduleSelected !== self::ALL_MODULES) {
            $this->emit('moduleSelected', $this->moduleSelected);
        } else {
            $this->emit('moduleSelected', null);
        }
    }
}
