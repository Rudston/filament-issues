<?php

// @see https://github.com/wire-elements/modal

namespace App\Http\Livewire\Video;

use App\Models\Assets\VideoTag;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class ManageVideoTagsModal extends ModalComponent implements HasForms
{

    use WithPagination;
    use InteractsWithForms;

    protected $listeners = [
        'textsQueried' => 'onTextsQueried',
        'rowDeleted' => '$refresh'
    ];

    public array $queryParams;
    public array $columnSorts;

    public array $columns = [
        'name',
        'notes',
        'edit',
        'delete'
    ];

    // Edit form variables
    public $name;
    public $notes;
    public $tagIdEditing;

    public array $columnsWithSortDeactivated = [
        'edit',
        'delete'
    ];
    public function mount()
    {
        $this->queryParams = [];
        $this->columnSorts = [];
        $this->form->fill(
            [
                'name' => '',
                'notes' => ''
            ]
        );
        $this->tagIdEditing = 0;
    }

    public function processSearchQuery(): Builder
    {
        $query = VideoTag::query();
        foreach ($this->queryParams as $k => $queryArray) {
            if ($k == 'texts') {
                $query->where(function ($q) use ($queryArray) {
                    $q->where('name', $queryArray[1], "{$queryArray[2]}")
                        ->orWhere('notes', $queryArray[1], "{$queryArray[2]}");

                });
            }
        }
        if (count($this->columnSorts)) {
            $orderByRawClause = "";
            foreach ($this->columnSorts as $column => $order) {
                $orderByStr = "$column $order";
                $orderByRawClause .= $orderByRawClause ? ", " . $orderByStr : $orderByStr;
            }
            return $query->orderByRaw($orderByRawClause);
        } else {
            return $query->orderBy('name', 'ASC');
        }
    }

    public function onTextsQueried($query)
    {
        if ($query !== null) {
            $this->queryParams['texts'] = ['where', 'like', "%$query%"];
        } else {
            unset($this->queryParams['texts']);
        }
        $this->resetPage();
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->label('Name')
                ->required(),
            Textarea::make('notes')
                ->rows(2)
                ->label('Notes'),
        ];
    }

    public function render()
    {
        $query = $this->processSearchQuery();
        return view('livewire.video.manage-video-tags-modal',
        ['tags' => $query->paginate(20)]);
    }

    public function editTag(VideoTag $tag)
    {
        $this->form->fill([
                'name' => $tag->name,
                'notes' => $tag->notes
            ]
        );
        $this->tagIdEditing = $tag->id;
    }

    public function save()
    {
        $formState = $this->form->getState();
        if ($this->tagIdEditing) {
            $videoTag = VideoTag::find($this->tagIdEditing);
            $videoTag->update($formState);
        } else {
            $videoTag = VideoTag::create($formState);
            $this->tagIdEditing = $videoTag->id;
        }
    }

    public function cancelEdit()
    {
        $this->tagIdEditing = 0;
        $this->form->fill([
                'name' => '',
                'notes' => ''
            ]
        );
    }
}
