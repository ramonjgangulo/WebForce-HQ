<?php

namespace App;

use App\Http\Requests\ProductRequest;
use http\Client\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Product extends Model implements HasMedia
{
    use SoftDeletes,HasMediaTrait;

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
        $products = static::all();
        foreach ($products as $product){
            $product['img'] = $product->getFirstMediaUrl('img');
        }
        return $products;
    }

    public static function store($product,$img)
    {
        try{
            $product['product_slug']=Str::slug($product['product_name'],'-');

            static::create($product)
                ->addMedia($img)
                ->usingFileName($product['product_slug'].'.jpg')
                ->toMediaCollection('img');

            return true;
        }catch (Exception $e){
            return false;
        }
    }
    public static function show($id)
    {
        $product = static::find($id);
        $product['img'] = $product->getFirstMediaUrl('img');
        return $product;
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
    public static function uploadPhoto($photo,$id)
    {
        $product = static::find($id);

        $product->addMedia($photo)
                ->toMediaCollection('img');

        return response()->json(['message' => 'success']);
    }
    public static function showPhoto($id)
    {
        $product = static::find($id);
        $photo = $product->getFirstMedia('img')->getUrl();
        return $photo;
    }

}
