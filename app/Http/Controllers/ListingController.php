<?php

namespace App\Http\Controllers;

use App\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        return Listing::all();
    }

    public function show(Listing $listing)
    {
        return $listing;
    }

    public function store(Request $request)
    {
        $listing = Listing::create($request->all());

        return response()->json($listing, 201);
    }

    public function update(Request $request, Listing $listing)
    {
        $listing->update($request->all());

        return response()->json($listing);
    }

    public function delete(Request $request, Listing $listing)
    {
        $listing->delete();

        return response()->json(null, 204);
    }
}
