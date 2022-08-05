<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\EstController;
use App\Models\CategoryModel;
use App\Models\EventModel;

class HomeController extends EstController
{
    public function getUpcoming() {
    	
    	$categories = CategoryModel::whereHas('events', function($query) {
            $query->where('events.status', _STATUS_ACTIVE_);
        })->get();

        return view('site.homepage', compact('categories'));
    }

}
