<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
class ProductController extends Controller
{
    public function __construct()
    {
        //restricting certain endpoints access, so only users can access them
        $this->middleware('jwt')->only(['store','update','destroy']);
    }
    public function index()
    {
        return response()->json(Product::showAll(),200);
    }

    public function store(ProductRequest $request)
    {
        if(Product::store($request->all()))
            return response()->json(['message' => 'success'],201);
        return response()->json(['message' => 'error'],500);
    }

    public function show($id)
    {
        return response()->json(Product::show($id),200);
    }

    public function update(ProductRequest $request,$id)
    {
        if(Product::tryUpdate($request->all(),$id))
            return response()->json(['message' => 'success'],204);
        return response()->json(['message' => 'error'],500);
    }

    public function destroy($id)
    {
        if(Product::softDelete($id))
            return response()->json(['message' => 'success'],204);
        return response()->json(['message' => 'error'],500);
    }
}
