<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable,SoftDeletes,HasRoles;

    protected $table='users';

    protected $primaryKey='user_id';

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'user_name',
        'user_email',
        'user_password',
    ];

    protected $hidden = [
        'password',
    ];

    public static function store($user)
    {
        try{
            $user['user_password']=Hash::make($user['user_password']);
            static::create($user);
            return true;
        }catch (Exception $e){
            return false;
        }
    }
    public static function tryUpdate($request ,$id)
    {
        try{
            $request['user_password']=Hash::make($request['user_password']);
            static::find($id)->update($request);
            return true;
        }catch(Exception $e){
            return false;
        }
    }
    public static function softDelete($id)
    {
        try{
            $product = static::find($id);
            $product->delete();
            return true;
        }catch(Exception $e){
            return false;
        }
    }
}
