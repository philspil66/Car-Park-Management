<?php

namespace App\Models;
use App\Models\EstModel;

use Illuminate\Database\Eloquent\Model;

class TeamModel extends EstModel
{
    protected $table = 'teams';

    public function lang() {

        return $this->hasOne('App\Models\TeamLangModel', 'team_id', 'id');
    }

    public function category() {

        return $this->belongsTo('App\Models\CategoryModel', 'category_id', 'id');
    }

}
