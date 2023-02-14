<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class GenericTextSearchBar extends Component
{
    public $query;
    public $itemQueried; // required! - add to individual component
    public $classes;     // add to individual component (the whole div)
    public $width; // default 200px otherwise add to individual component
    public $placeholder; // add to individual component
    public $ident; // required if > 1 on the same page! - add to individual component

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
        $this->emit($this->itemQueried.'Queried', '');
    }

    public function updatedQuery()
    {
        $this->emit($this->itemQueried.'Queried', $this->query);
    }

    public function render()
    {
        return view('livewire.components.generic-text-search-bar');
    }
}
