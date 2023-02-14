<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class DateSearch extends Component
{
    public $theDate = null;
    public $displayDate = null;
    public $whichDate; // pass as property to individual view instance - includes either '-mobile' or '-desktop'
    public $placeholder; // pass as property to individual view instance
    public $classes;// pass as property to individual view instance
    public $ident;// pass as property to individual view instance NB: added to use as a custom "key" to distinguish mobile / desktop

    protected $listeners = ['searchCleared' => 'onSearchCleared'];

    public function onSearchCleared() {
        $this->theDate = null;
        $this->displayDate = null;
    }

    public function render()
    {
        return view('livewire.components.date-search');
    }

    public function clear()
    {
        $this->theDate = null;
        $this->displayDate = null;
        $this->emit('theDateSet', ['whichDate' => $this->whichDate, 'value' => $this->theDate]);
    }

    public function updatedTheDate()
    {
        $this->emit('theDateSet', ['whichDate' => $this->whichDate, 'value' => $this->theDate]);
    }
}
