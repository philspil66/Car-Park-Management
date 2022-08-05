<?php

namespace App\Http\Controllers;

use App\Models\CarParkOwnerModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\EstController;
use App\Models\CarParkModel;
use App\Models\CarParkLangModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Classes\CarPark;
use App\Classes\UserHelper;

class CarParksController extends EstController
{

    public function getFeatured()
    {

        $car_parks = CarParkModel::where('featured', 'true')->get();
        return view('site.car-parks', compact('car_parks'));

    }

    /**
     * For setting up add / edit car park form
     *
     * @return void
     */

    public function addAmendForm()
    {

        $carParkId = Input::get('id');
        $addAmendForm = array();

        // get the users that have a role of car park owners
        $carParkOwnersList = UserHelper::getAllCarParkOwners($carParkId);

        $addAmendForm['owners'] = $carParkOwnersList['owners'];

        //the current car parks owner
        $addAmendForm['owner']= $carParkOwnersList['owner'];

//        dd($addAmendForm['owners']);
        try {

            if ($carParkId) {    // edit

                $CarPark = CarParkModel::find($carParkId);

                $addAmendForm['mode'] = 'Edit';
                $addAmendForm['carParkId'] = $CarPark->id;
                $addAmendForm['capacity'] = $CarPark->capacity;
                $addAmendForm['lat'] = $CarPark->lat;
                $addAmendForm['long'] = $CarPark->long;
                $addAmendForm['sku'] = $CarPark->sku;
                $addAmendForm['priority'] = $CarPark->priority;
                $addAmendForm['featured'] = $CarPark->featured;
                $addAmendForm['name'] = $CarPark->lang->name;
                $addAmendForm['description'] = $CarPark->lang->description;
                $addAmendForm['directions'] = $CarPark->lang->directions;


            } else { // add

                $addAmendForm['mode'] = 'Add';
                $addAmendForm['capacity'] = '';
                $addAmendForm['lat'] = '';
                $addAmendForm['long'] = '';
                $addAmendForm['featured'] = '';
                $addAmendForm['name'] = '';
                $addAmendForm['sku'] = '';
                $addAmendForm['priority'] = '';
                $addAmendForm['description'] = '';
                $addAmendForm['directions'] = '';

            }
//            dd($addAmendForm);

        } catch (\Exception $ex) {

            \Log::info('Error in Add / Amend Form (Car Parks). ' . __FILE__ . ' line ' . __LINE__ . ' --> ' . $ex->getMessage());
            Session::flash('error', 'Error in Add / Amend Form (Car Parks).');
            die($ex->getMessage());

        }

        return view('admin.carparks.carparks-add-edit', compact('addAmendForm'));

    }

    /**
     * Add / Edit a car park
     *
     * @return void
     */

    public function addAmendCarPark()
    {

        $validator = CarPark::validateAddEditCarparkInput(Input::all());

        if ($validator->fails()) {

            return Redirect::back()->withInput()->withErrors($validator);

        }

        try {

            $carParkId = Input::get('car_park_id');

            if ($carParkId) {  // edit car park

                $CarPark = CarParkModel::find($carParkId);

                $CarPark->capacity = Input::get('car_park_capacity');
                $CarPark->lat = Input::get('car_park_lat');
                $CarPark->long = Input::get('car_park_long');
                $CarPark->sku = Input::get('car_park_sku');
                $CarPark->priority = Input::get('car_park_priority');
                $CarPark->featured = Input::get('car_park_featured');
                $CarPark->lang->name = Input::get('car_park_name');
                $CarPark->lang->description = Input::get('car_park_description');
                $CarPark->lang->directions = Input::get('car_park_directions');


                $carParkOwner = CarParkOwnerModel::where('car_park_id', '=', $carParkId)->first();
                if (!$carParkOwner) {
                    $carParkOwner = new CarParkOwnerModel();
                }
                $carParkOwner->user_id = Input::get('owners');
                $carParkOwner->car_park_id = $carParkId;


                $carParkOwner->save();
                $CarPark->save();
                $CarPark->lang->save();

                Session::flash('success', 'Car park has been updated successfully.');
                return Redirect::to('/admin/carparks/add-edit?id=' . $carParkId);

            } else { // add car park

                $CarPark = new CarParkModel();
                $CarPark->capacity = Input::get('car_park_capacity');
                $CarPark->lat = Input::get('car_park_lat');
                $CarPark->long = Input::get('car_park_long');
                $CarPark->sku = Input::get('car_park_sku');
                $CarPark->priority = Input::get('car_park_priority');
                $CarPark->featured = Input::get('car_park_featured');
                $CarPark->save();

                $CarParkLang = new CarParkLangModel();
                $CarParkLang->car_park_id = $CarPark->id;
                $CarParkLang->name = Input::get('car_park_name');
                $CarParkLang->description = Input::get('car_park_description');
                $CarParkLang->directions = Input::get('car_park_directions');
                $CarParkLang->save();

                $carParkOwner = new CarParkOwnerModel();
                $carParkOwner->user_id = Input::get('owners');
                $carParkOwner->car_park_id = $CarPark->id;
                $carParkOwner->save();

                Session::flash('success', 'Car Park has been added successfully.');
                return Redirect::to('/admin/carparks/add-edit?id=' . $CarPark->id);

            }

        } catch (\Exception $ex) {

            \Log::info('Error in Add / Amend Car Park. ' . __FILE__ . ' line ' . __LINE__ . ' --> ' . $ex->getMessage());
            Session::flash('error', 'Error in Add / Amend Car Park.');
            die($ex->getMessage());

        }

    }

}
