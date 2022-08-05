<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class PrintSheetsController extends Controller
{
    public function printSheetsByPlateNumber() {
        
        $id = Input::get('event_id');
        $Event = \App\Models\EventModel::find( $id );
        
        $carpark_id = Input::get('carpark_id');
        $Carpark = \App\Models\CarParkModel::find( $carpark_id );
        
        $title = $Carpark->lang->name.' ('. $Event->lang->title. ' - '. \App\Classes\Tools::dateformat($Event->date).' @ '.\App\Classes\Tools::timeformat($Event->time) .')';
        $results = \App\Classes\Plate::getListOfPlatesAndNamesForCarpark( $id, $carpark_id );
        
        $plate = array();
        foreach ($results as $key => $row)
        {
            $plate[$key] = $row->plate_number;
        }
        array_multisort($plate, SORT_ASC, $results);        
        $sorting = 'plate';
        
        return view('admin.print-sheets', compact('title', 'results', 'sorting'));
        
    }
    
    public function printSheetsByName() {
        
        $id = Input::get('event_id');
        $Event = \App\Models\EventModel::find( $id );

        $carpark_id = Input::get('carpark_id');
        $Carpark = \App\Models\CarParkModel::find( $carpark_id );
        
        $title = $Carpark->lang->name.' ('. $Event->lang->title. ' - '. \App\Classes\Tools::dateformat($Event->date).' @ '.\App\Classes\Tools::timeformat($Event->time) .')';
        $results = \App\Classes\Plate::getListOfPlatesAndNamesForCarpark( $id, $carpark_id );

        $name = array();
        foreach ($results as $key => $row)
        {
            $name[$key] = $row->lastname;
        }
        array_multisort($name, SORT_ASC, $results);        
                
        $sorting = 'name';
        return view('admin.print-sheets', compact('title', 'results', 'sorting'));
        
    }
    
}
