<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return Product::select(['id', 'name', 'price', 'slug'])
            ->when(
                !empty($request->search),
                fn($query) => $query->where('name', 'LIKE', "%$request->search%")
            )
            ->when(
                !empty($request->maxPrice),
                fn($query) => $query->where('price', '<=', $request->maxPrice)
            )
            ->when(
                !empty($request->minPrice),
                fn($query) => $query->where('price', '>=', $request->minPrice)
            )
            ->get();
    }

    public function show(Request $request, $id) //Product $product)
    {
        $product = new Product();
        return $product->resolveRouteBinding(
            $id,
            $request->field
        );

    }
}