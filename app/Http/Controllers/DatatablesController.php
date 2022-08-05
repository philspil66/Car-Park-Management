<?php

namespace App\Http\Controllers;

use App\Classes\UserHelper;
use App\User;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class DatatablesController extends EstController
{

    public function getUsersData()
    {

//        \Log::info('Classes: DatatablesController:getAllUsers - Started');
        $users = \App\Classes\UserHelper::getAllUsers();
//        print_r(json_encode($users));


        $result = Datatables::of(collect($users))->make(true);
//        \Log::info($result);

        return Datatables::of(collect($users))->make(true);
    }

    public function getOrdersData()
    {
        $orders = \App\Classes\Order::getOrdersListing();
        return Datatables::of(collect($orders))->make(true);
    }

    public function getCategoriesData()
    {

        $categories = DB::table('categories')
            ->leftJoin('categories_lang', 'categories_lang.category_id', '=', 'categories.id')
            ->select('categories.id',
                'categories.type',
                'categories_lang.description'
            )
            ->get();

        return Datatables::of(collect($categories))->make(true);

    }

    public function getCarParksData()
    {

        $carParks = DB::table('car_parks')
            ->leftJoin('car_parks_lang', 'car_parks_lang.car_park_id', '=', 'car_parks.id')
            ->select('car_parks.id',
                'car_parks.sku',
                'car_parks.capacity',
                'car_parks.priority',
                'car_parks_lang.name'
            )
            ->get();

        return Datatables::of(collect($carParks))->make(true);

    }

    public function getTeamsData()
    {

        $teams = DB::table('teams')
            ->leftJoin('teams_lang', 'teams.id', '=', 'teams_lang.team_id')
            ->leftJoin('categories', 'categories.id', '=', 'teams.category_id')
            ->leftJoin('categories_lang', 'categories_lang.category_id', '=', 'categories.id')
            ->select('teams.id',
                'teams_lang.name',
                'categories_lang.description'
            )
            ->orderBy('id')
            ->get();

        return Datatables::of(collect($teams))->make(true);

    }

    public function getWastageReasonsData(){

        $wastageReasons = DB::table('wastage_reasons')
                    ->leftJoin( 'wastage_reasons_lang', 
                                'wastage_reasons_lang.wastage_reason_id', '=', 'wastage_reasons.id')
                    ->select('wastage_reasons.id', 'wastage_reasons_lang.description')
                    ->orderBy('description')
                    ->get();

        return Datatables::of( collect($wastageReasons))->make(true);

    }

}
