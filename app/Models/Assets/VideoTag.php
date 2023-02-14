<?php

namespace App\Models\Assets;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class VideoTag extends Model
{
    protected $fillable = ['name', 'notes'];

    /* =========================================== *
   *              Relationships
   * =========================================== */
    public function videos():BelongsToMany
    {
        return $this->belongsToMany(Video::class, 'video_tags_videos', 'video_tag_id','video_id');
    }
}

