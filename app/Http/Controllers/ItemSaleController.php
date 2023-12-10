<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemSaleResource;
use App\Models\ItemSale;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $itemSale = ItemSale::create($request->all());

        return response($itemSale, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemSale $itemSale)
    {
        // When necessary loading relationships previaly
        $itemSale->load('product');

        return new ItemSaleResource($itemSale);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemSale $itemSale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemSale $itemSale)
    {
        //
    }
}
