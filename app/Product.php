<?php

namespace App;

use App\Http\Requests\ProductRequest;
use http\Client\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'Products';

    protected $primaryKey = 'product_id';

    public $incrementing = true;

    public $timestamps = true;

    public $fillable = [
        'product_name',
        'product_slug',
        'product_description',
        'product_price'
    ];
    public static $showable =[
      'product_name',
      'product_description',
      'product_price'
    ];

    public static function showAll()
    {
        return static::select(static::$showable)->get();
    }

    public static function store($product)
    {
        try{
            $product['product_slug']=Str::slug($product['product_name'],'-');
            static::create($product);
            return true;
        }catch (Exception $e){
            return false;
        }
    }
    public static function show($id)
    {
        return static::select(static::$showable)->first();
    }
    public static function tryUpdate($request ,$id)
    {
        try{
            $request['product_slug']=Str::slug($request['product_name'],'-');
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
