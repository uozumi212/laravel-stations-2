<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sheet;

class SheetsController extends Controller
{
    //
    public function index(){
        $sheets = Sheet::all();
        return view('sheets',compact('sheets'));
    }
}
