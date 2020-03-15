<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable,SoftDeletes;

    protected $table='users';

    protected $primaryKey='user_id';

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'user_name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier(){return $this->getKey();}
    public function getJWTCustomClaims(){return [];}

    public static function store($user)
    {
        try{
            $user['password']=Hash::make($user['password']);
            static::create($user);
            return true;
        }catch (Exception $e){
            return false;
        }
    }
    public static function tryUpdate($request ,$id)
    {
        try{
            // if a password was updated, it changes the value, to its encryption
            if(array_key_exists('password',$request))
                $request['password']=Hash::make($request['password']);
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
