<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getCitiesByState($state_id)
    {
        $cities = City::where('state_id', $state_id)
            ->orderBy('name')
            ->get(['id', 'name']);
        
        return response()->json($cities);
    }
}
