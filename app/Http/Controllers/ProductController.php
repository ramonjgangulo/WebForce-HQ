<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::showAll(),200);
    }

    public function store(Request $request)
    {
        dd($request->all());

        if(Product::store($request->all()))
            return response()->json(['message' => 'success'],200);
        return response()->json(['message' => 'error']);
    }

    public function show($id)
    {
        return response()->json(Product::show($id),200);
    }

    public function update(ProductRequest $request,$id)
    {
        dd($request->all());
        if(Product::tryUpdate($request->all(),$id))
            return response()->json(['message' => 'success']);
        return response()->json(['message' => 'error']);
    }

    public function destroy($id)
    {
        if(Product::softDelete($id))
            return response()->json(['message' => 'success']);
        return response()->json(['message' => 'error']);
    }
}
