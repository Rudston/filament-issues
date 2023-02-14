<?php

namespace App\Http\Livewire\Components;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CourseSearchBar extends Component
{
    public $query;
    public $courses;
    public $courseTitleSelected;
    public $courseGroupIdSelected;
    public $classes;// pass as property to individual view instance

    protected $listeners = ['searchCleared' => 'onSearchCleared'];

    public function onSearchCleared() {
        $this->query = '';
        $this->courses = [];
        $this->courseTitleSelected = "";
        $this->courseGroupIdSelected = null;
    }

    public function mount()
    {
        $this->resetVars();
    }

    public function resetVars()
    {
        $this->query = '';
        $this->courses = [];
        $this->courseTitleSelected = "";
        $this->courseGroupIdSelected = 0;
        $this->emit('courseSelected', '', null);
    }

    // Note: parent component receives both arguments
    public function selectCourse($courseTitle, $courseGroupId)
    {
        $this->courseTitleSelected = $courseTitle;
        $this->query = '';
        $this->emit('courseSelected', $courseTitle, $courseGroupId);
    }

    public function updatedQuery()
    {
        if ($this->query != '') {
            $result = DB::connection('mysql_vle') // actually course groups
            ->table('course_group')
                ->select('course_title', 'course_group_id')
                ->where('course_title', 'like', '%' . $this->query . '%')
                ->orderBy('course_title', 'ASC')
                ->get();
            if ($result-> count()) {
                $this->courses = $result->toArray();
            } else {
                $this->courses = [];
            }
        } else {
            $this->courses = [];
        }
    }

    public function render()
    {
        return view('livewire.components.course-search-bar');
    }
}
