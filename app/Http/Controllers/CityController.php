<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $city = $request->city;
        
        return view('city', ['city' => $city]);
    }

}
