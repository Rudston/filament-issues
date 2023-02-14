<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class StudentSearchBar extends Component
{
    public $query;

    public $classes;     // add to individual component
    public $placeholder; // add to individual component

    protected $listeners = ['searchCleared' => 'onSearchCleared'];

    public function onSearchCleared() {
        $this->query = null;
    }

    public function mount()
    {
        $this->resetVars();
    }

    public function resetVars()
    {
        $this->query = '';
        $this->emit('studentQueried', '');
    }

    public function updatedQuery()
    {
        $this->emit('studentQueried', $this->query);
    }

    public function render()
    {
        return view('livewire.components.student-search-bar');
    }
}
