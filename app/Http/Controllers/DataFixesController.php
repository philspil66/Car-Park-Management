<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DataFixesController extends Controller
{

    public function removeInvalidPhoneNumbers() {
        \App\Classes\DataFixes::removeInvalidPhoneNumbers();
    }
}
