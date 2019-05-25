<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    public function projectTags(){
        return $this->hasMany('App\ProjectTag');
    }
}
