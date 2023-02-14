<?php

/**
 * Added this to deal with the following issue:
 * 1. Do a search in the list view (e.g. tutors dashboard)
 * 2. Go to edit
 * 3. Return with the back button to the list: text search e.g. values are still displayed as initially inserted, although
 * all records are listed
 *
 * With this the search is cleared before the edit view is displayed
 */
namespace App\Http\Livewire\Components;

use Livewire\Component;

class GenericEditButton extends Component
{
    public $route;
    public $buttonText = 'Edit';

    public function render()
    {
        return view('livewire.components.generic-edit-button');
    }

    public function edit()
    {
        $this->emit('searchCleared');
        $this->redirect($this->route);
    }
}
