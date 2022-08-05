<?php

namespace App\Models;
use App\Models\EstModel;

use Illuminate\Database\Eloquent\Model;

class EventModel extends EstModel
{
    protected $table = 'events';

//    public function getdateAttribute($input) { // for mysterious reasons doesn't work

//        //return App\Classes\Tools::dateformat($input);

//    }

    public function lang() {

        return $this->hasOne('App\Models\EventLangModel', 'event_id', 'id');
    }

    public function teamone() {

        return $this->belongsTo('App\Models\TeamModel', 'team1_id', 'id');
    }

    public function teamtwo() {

        return $this->belongsTo('App\Models\TeamModel', 'team2_id', 'id');
    }

    public function category() {

        return $this->belongsTo('App\Models\CategoryModel', 'category_id', 'id');
    }

    public function products() {

        return $this->hasMany('App\Models\ProductModel', 'event_id', 'id');
    }


}
