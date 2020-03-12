<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class MediaController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        $photo = Product::uploadPhoto($request->photo,$request->id);

        return response()->json(['photo' => $photo]);
    }

    public function show($id)
    {
        return response()->json(['photo' => Product::showPhoto($id)]);
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
