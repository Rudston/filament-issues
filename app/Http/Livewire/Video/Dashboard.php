<?php

namespace App\Http\Livewire\Video;

use Session;
use App\Models\Assets\Video;
use App\Models\Assets\VideoTag;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    protected $listeners = [
        'allTextsQueried' => 'onAllTextsQueried',
        'tagsQueried' => 'onTagsQueried',
        'theDateSet' => 'onTheDateSet',
        'columnSortOrderChanged' => 'onColumnSortOrderChanged',
        'rowDeleted' => '$refresh'
    ];

    public array $queryParams;
    public array $columnSorts;

    public array $columns = [
        'date',
        'title',
        'description',
        'tags',
        'view',
        'edit',
        'delete'
    ];

    public array $tableHeaders = [
        'date' => 'Date',
        'title' => 'Title',
        'description' => 'Description',
        'tags' => 'Tags',
        'view' => '',
        'edit' => '',
        'delete' => ''
    ];

    public array $columnsWithSortDeactivated = [
        'description',
        'view',
        'edit',
        'delete',
        'tags'
    ];

    public bool $isAdminUser;

    public function mount()
    {
        $this->queryParams = [];
        $this->columnSorts = [];
        $this->isAdminUser = true;
    }

    public function render(): View
    {
        $query = $this->processSearchQuery();
        $videoTags = VideoTag::all()->sortBy('name');
        return view('livewire.video.dashboard',
            [
                'videos' => $query->paginate(50),
                'videoTags' => $videoTags
            ])
            ->layout('layouts.admin.livewire-focus', ['title' => 'Videos > Dashboard']);
    }

    public function processSearchQuery(): Builder
    {
        $query = Video::query()->with('tags');
        foreach ($this->queryParams as $k => $queryArray) {
            if ($k == 'texts') {
                $query->where(function ($q) use ($queryArray) {
                    $q->where('title', $queryArray[1], "{$queryArray[2]}")
                        ->orWhere('description', $queryArray[1], "{$queryArray[2]}");

                });
            } elseif ($k == 'date_from') {
                $query->where('webinar_date', $queryArray[1], "{$queryArray[2]}"); // >=
            } elseif ($k == 'date_to') {
                $query->where('webinar_date', $queryArray[1], "{$queryArray[2]}"); // <=
            } elseif ($k == 'tags') {
                $tagIds = $queryArray[2];
                // we want videos having ALL these tags: AND relationship
                foreach ($tagIds as $tagId) {
                    $query->whereHas('tags', function ($q) use ($tagId) {
                        $q->where('video_tags.id', '=', $tagId);
                    });
                }
            } else {
                $query->{$queryArray[0]}("{$k}", $queryArray[1], "{$queryArray[2]}");
            }
        }

        if (count($this->columnSorts)) {
            $orderByRawClause = "";
            foreach ($this->columnSorts as $column => $order) {
                if ($column == 'date') {
                    $column = 'webinar_date';
                }
                $orderByStr = "$column $order";
                $orderByRawClause .= $orderByRawClause ? ", " . $orderByStr : $orderByStr;
            }
            return $query->orderByRaw($orderByRawClause);
        } else {
            return $query->orderBy('webinar_date', 'DESC');
        }
    }

    public function onAllTextsQueried($query)
    {
        if ($query !== null) {
            $this->queryParams['texts'] = ['where', 'like', "%$query%"];
        } else {
            unset($this->queryParams['texts']);
        }
        $this->resetPage();
    }

    public function onTagsQueried(array $query)
    {
        if (count($query)) {
            $this->queryParams['tags'] = ['where', '=', $query];
        } else {
            unset($this->queryParams['tags']);
        }
        $this->resetPage();
    }

    public function onTheDateSet($dateInfos)
    {
        $whichDate = $dateInfos['whichDate'];
        $value = $dateInfos['value'];
        if ($whichDate == 'date_from') {
            if ($value != null) {
                $this->queryParams['date_from'] = ['where', '>=', $value];
            } else {
                unset($this->queryParams['date_from']);
            }
        } elseif ($whichDate == 'date_to') {
            if ($value != null) {
                $this->queryParams['date_to'] = ['where', '<=', $value];
            } else {
                unset($this->queryParams['date_to']);
            }
        }
        $this->resetPage();
    }

    public function onColumnSortOrderChanged(array $data)
    {
        $sortOrder = $data['sortOrder'];
        $column = $data['column'];
        if ($sortOrder == 'none') {
            unset($this->columnSorts[$column]);
        } else {
            $this->columnSorts[$column] = $sortOrder;
        }
        $this->resetPage();
    }

    public function clearSearch($active)
    {
        if ($active) {
            $this->queryParams = [];
            $this->columnSorts = [];
            $this->resetPage();
            $this->emit('searchCleared');
        }
    }

    public function getClearSearchEnabledProperty(): bool
    {
        return count($this->queryParams) > 0 || count($this->columnSorts) > 0;
    }
}
