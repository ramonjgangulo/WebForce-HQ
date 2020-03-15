<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return response()->json(User::all(),200);
    }

    public function store(UserRequest $request)
    {
        if(User::store($request->all()));
            return response()->json(['message' => 'success'],201);
        return response()->json(['message' => 'failure'],500);
    }

    public function show($id)
    {
        return response()->json(User::find($id),200);
    }

    public function update(UserRequest $request, $id)
    {
        if(User::tryUpdate($request->all(),$id))
            return response()->json(['message' => 'success'],204);
        return response()->json(['message' => 'failure'],500);
    }

    public function destroy($id)
    {
        if(User::softDelete($id))
            return response()->json(['message' => 'success'],204);
        return response()->json(['message' => 'failure'],500);
    }
}
