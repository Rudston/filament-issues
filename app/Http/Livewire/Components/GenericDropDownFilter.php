<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class GenericDropDownFilter extends Component
{
    public array $options;
    public string $itemToFilter;
    public int $width; // default 200 (px)
    public $classes;     // add to individual component

    public $optionSelected;
    const ANY_OPTIONS = 'Any'; // be careful when supplying this value as it means the query is nullified

    protected $listeners = ['searchCleared' => 'onSearchCleared'];

    public function onSearchCleared() {
        $this->optionSelected = null;
    }

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.components.generic-drop-down-filter');
    }

    public function updatedOptionSelected()
    {
        if ($this->optionSelected !== self::ANY_OPTIONS) {
            $this->emit($this->itemToFilter . "Selected", $this->optionSelected);
        } else {
            $this->emit($this->itemToFilter . "Selected", null);
        }
    }
}
