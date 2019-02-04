<?php

namespace App\Http\Controllers;

use App\Developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function index()
    {
        return Developer::all();
    }

    public function show(Developer $developer)
    {
        return $developer;
    }

    public function store(Request $request)
    {
        $developer = Developer::create($request->all());

        return response()->json($developer, 201);
    }

    public function update(Request $request, Developer $developer)
    {
        $developer->update($request->all());

        return response()->json($developer);
    }

    public function delete(Request $request, Developer $developer)
    {
        $developer->delete();

        return response()->json(null, 204);
    }
}
