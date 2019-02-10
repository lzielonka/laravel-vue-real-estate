<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        return City::all();
    }

    public function show(City $city)
    {
        return $city;
    }

    public function store(Request $request)
    {
        $city = City::create($request->all());

        return response()->json($city, 201);
    }

    public function update(Request $request, City $city)
    {
        $city->update($request->all());

        return response()->json($city);
    }

    public function delete(Request $request, City $city)
    {
        $city->delete();

        return response()->json(null, 204);
    }
}
