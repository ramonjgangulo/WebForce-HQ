<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaRequest;
use Illuminate\Http\Request;
use App\Product;
class MediaController extends Controller
{
    public function __construct()
    {
        //restricting certain endpoints access, so only users can access them
        $this->middleware('jwt')->only(['store']);
    }

    public function index(){}

    public function store(MediaRequest $request)
    {

        if(Product::uploadImage($request->file('product_image'),$request->input('product_id')))
            return response()->json(['message' => 'success'],201);
        return response()->json(['message' => 'error'],500);
    }

    public function show($id)
    {
        return response()->json(['product_images' => Product::getImages($id)],200);
    }

    public function update(){}

    public function destroy(){}
}
