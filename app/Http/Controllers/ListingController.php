<?php

namespace App\Http\Controllers;

use App\Models\Listing;
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
        $this->validate($request, [
            'name' => 'required|min:5|max:191|unique:lists,name',
            'price' => 'required|integer|between:1,2147483648',
            'city_id' => 'required|exists:cities,id',
            'developer_id' => 'required|exists:developers,id',
            'isOnSale' => 'required|integer|between:0,1',
        ]);

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
