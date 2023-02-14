<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class GenericMultiSelectFilter extends Component
{
    public $options;

    public $query;
    public $itemQueried; // required! - add to individual component

    public $classes;

    public $width;

    protected $listeners = [
        'searchCleared' => 'resetVars'
    ];

    public function onSearchCleared() {
        $this->query = null;
    }

    public function mount()
    {
        $this->resetVars();
    }

    public function resetVars()
    {
        $this->query = [];
        $this->emit($this->itemQueried.'Queried', []);
    }

    public function remove($tagId)
    {
        if (($key = array_search($tagId, $this->query)) !== false) {
            unset($this->query[$key]);
        }
        $this->emit($this->itemQueried.'Queried', $this->query);
    }

    public function updatedQuery()
    {
        $this->emit($this->itemQueried.'Queried', $this->query);
    }

    public function render()
    {
        return view('livewire.components.generic-multi-select-filter');
    }
}
