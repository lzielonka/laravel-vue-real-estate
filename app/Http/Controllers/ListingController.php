<?php

namespace App\Http\Controllers;

use App\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $query = (new Listing)->newQuery();

        if ($request->has('city_id')) {
            $query->where('city_id', $request->get('city_id'));
        }
        if ($request->has('developer_id')) {
            $query->where('developer_id', $request->get('developer_id'));
        }
        if ($request->has('price')) {
            $query->where('price', '<=', $request->get('price'));
        }
        if ($request->has('isOnSale')) {
            $query->where('isOnSale', $request->get('isOnSale'));
        }

        return $query->get();
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
