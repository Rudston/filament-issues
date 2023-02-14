<?php

namespace App\Models\Assets;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;
    protected $guarded = []; // @todo

    /* =========================================== *
   *              Relationships
   * =========================================== */
    public function tags():BelongsToMany
    {
        return $this->belongsToMany(VideoTag::class, 'video_tags_videos', 'video_id','video_tag_id');
    }

    /* =========================================== *
     *              Dashboard
     * =========================================== */
    public function getColumn(string $column, bool $mobile=false): string
    {
        if ($column == 'edit') {
            return route('edit.video',['video' => $this->id]);;
        } elseif ($column == 'view') {
            return route('view.video', ['video' => $this->id]);
        } elseif ($column == 'delete') {
            return 'Delete';
        } elseif ($column == 'title') {
            return $this->title;
        } elseif ($column == 'description') {
            if (strlen($this->description) > 40) {
                return substr($this->description, 0, 40). " ...";
            } else {
                return $this->description;
            }
        } elseif ($column == 'tags') {
            $separator = $mobile ? ", " : "<br>";
            return $this->getTagsList($separator);
        } elseif ($column == 'date') {
            return $this->webinar_date ?? '';
        } else {
            return $this->{$column};
        }
    }
    public function getTagsList(string $separator): string
    {
        return implode($separator, $this->tags->sortBy('name')->pluck('name')->toArray());
    }
}
