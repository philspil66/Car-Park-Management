<?php

namespace App\Models;

use App\Models\EstModel;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends EstModel
{
    protected $table = 'categories';

    public function lang()
    {

        return $this->hasOne('App\Models\CategoryLangModel', 'category_id', 'id');
    }

    public function events()
    {

        return $this->hasMany('App\Models\EventModel', 'category_id', 'id')
            ->where('events.date', '>=', date('Y-m-d'))
            ->orderBy("events.date", "asc")
            ->whereHas('products', function ($query) {
                $query->where('products.status', _STATUS_ONLINE_);
            })->limit(2);
    }

    public function eventsOnlyActive()
    {

        return $this->hasMany('App\Models\EventModel', 'category_id', 'id')->where('events.date', '>=', date('Y-m-d'))->where('events.status', _STATUS_ACTIVE_)->orderBy("events.date", "asc")->whereHas('products', function ($query) {
            $query->where('products.status', _STATUS_ONLINE_);
        })->limit(2);
    }

}
