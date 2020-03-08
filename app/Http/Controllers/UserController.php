<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return response()->json(User::all());
    }

    public function store(UserRequest $request)
    {
        if(User::store($request->all()));
            return response()->json(['message' => 'success']);
        return response()->json(['message' => 'failure']);
    }

    public function show($id)
    {
        return response()->json(User::find($id));
    }

    public function update(UserRequest $request, $id)
    {
        dd($request->all());
        if(User::tryUpdate($request->all(),$id))
            return response()->json(['message' => 'success']);
        return response()->json(['message' => 'failure']);
    }

    public function destroy($id)
    {
        if(User::softDelete($id))
            return response()->json(['message' => 'success']);
        return response()->json(['message' => 'failure']);
    }
}
