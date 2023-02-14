<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class SortableColumnHeader extends Component
{
    public $column;
    public $label;
    public $sorting;
    public $sortOrder;
    public $active;
    public $deactivated;

    protected $listeners = ['searchCleared' => 'onSearchCleared'];

    public function render()
    {
        return view('livewire.components.sortable-column-header');
    }

    public function onSearchCleared() {
        $this->resetVars();
    }

    public function mount()
    {
        $this->resetVars();
    }

    public function resetVars()
    {
        $this->sorting = false;
        $this->sortOrder = 'none';
        if (!(isset($this->deactivated) && $this->deactivated === true)) {
            $this->active = true;
        }
    }

    public function toggleSortOrder()
    {
        if ($this->sortOrder == 'none') {
            $this->sorting = true;
            $this->sortOrder = 'ASC';
        } elseif($this->sortOrder == 'ASC') {
            $this->sorting = true;
            $this->sortOrder = 'DESC';
        } else {
            $this->sorting = false;
            $this->sortOrder = 'none';
        }
        $data = ['column' => $this->column, 'sortOrder' => $this->sortOrder];
        $this->emit('columnSortOrderChanged', $data);
    }
}
