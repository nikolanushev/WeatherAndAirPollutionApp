<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $city = $request->city;
        $path = base_path('storage/app/data.json');
        $url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $city . '&appid=c05deb87eec71a176c0f1a51024a6933';
        $response = file_get_contents($url);
        file_put_contents($path, $response);
        return view('city', ['city' => $city]);
    }

}
