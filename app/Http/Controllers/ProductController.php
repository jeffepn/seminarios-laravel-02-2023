<?php

namespace App\Http\Controllers;

use App\Events\CreateProductEvent;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return Product::select(['id', 'name', 'price', 'slug'])
            // when - When necessary appling "where" after pass in condition
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

    public function show(Request $request, $id)
    {
        $product = new Product();
        // When necessary to add specific logic in resolve bind route
        $product = $product->resolveRouteBinding(
            $id,
            $request->field
        );
        return new ProductResource($product);
    }

    public function store(ProductRequest $request)
    {
        // Option 1 - Used the instance of Product to set properties and save the resource
        // $product = new Product();
        // $product->name = $request->name;
        // $product->price = $request->input('price');
        // $product->save();

        // Option 2 - Used the create method to save the resource in only one call
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->input('price'),
        ]);

        // Dispatch an event when created Product
        event(new CreateProductEvent($product->id));

        return response($product, Response::HTTP_CREATED);
    }

    public function update(ProductRequest $request, Product $product)
    {
        // Option 1 - Set necessary properties to use update method
        // $product->update([
        //     'name' => $request->name,
        //     'price' => $request->input('price'),
        // ]);

        // Option 2 - Use the "only" method to get only necessary properties
        // $product->update($request->only(['name', 'price']));

        // Option 3 - How guaranteed that the property "fillable" of class
        // Product has only ["name", "price"], don't isdata and we can to get all
        // data of request
        $product->update($request->all());


        return response($product);
    }

    public function destroy(Product $product)
    {
        // We to used the soft delete, so the register in the "DB" will have a
        // date in "deleted_at"
        $product->delete();

        return response(['message' => "Produto excluído com sucesso."]);
    }

    public function revertDelete(Request $request)
    {
        $request->validate(
            [
                'ids' => 'required|array|min:1',
                'ids.*' => ['required', 'integer', 'exists:products,id']
            ],
            $request->all(),
        );

        // We to used the scope "withTrashed" to consider only deleted resources
        Product::withTrashed()
            // The method "whereIn" use the sql "IN" to consider only resource
            // that contains the ids provided how parameter
            ->whereIn('id', $request->ids)
            // The method "restore" remove the date "deleted_at" of consider resources
            ->restore();

        return response(['Produto(s) restaurado(s) com sucesso.']);
    }

    public function forceDestroy(Product $product)
    {
        // The "forceDelete" method bypasses soft delete and physically removes
        // the resource from the "DB"
        $product->forceDelete();

        return response(['message' => "Produto excluído com sucesso."]);
    }
}