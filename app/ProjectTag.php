<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTag extends Model
{
    protected $table = 'project_tags';

    public function project(){
        return $this->belongsTo('App\Project', 'project_id');
    }

    public function tag(){
        return $this->belongsTo('App\Tag', 'tag_id');
    }
}
