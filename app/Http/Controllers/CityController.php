<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $city = $request->city;
        $path = base_path('data.json');
        $url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $city . '&appid=c05deb87eec71a176c0f1a51024a6933';
        $response = file_get_contents($url);
        $returnedFile = file_get_contents($path);
        $finalFile = $returnedFile . "\n" . $response;
        file_put_contents($path, $finalFile);
        return view('city', ['city' => $city]);
    }

}
