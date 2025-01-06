<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Trans;

class Product extends Model
{
    use HasFactory, Trans;

    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class)->withDefault();
    }
    public function carts() {
      return $this->hasMany(Cart::class);
    }
    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function gallery() {
    return $this->morphMany(Image::class, 'imageable')->where('type', 'galary');
    }
    public function order_detailes() {
        return $this->hasMany(Order_Detaile::class);
    }

    public function getImgPathAttribute() {
        
       $src = 'https://via.placeholder.com/100x80'; 
       if($this->image) {
           $src = asset('images/'.$this->image->path);
       }

       return $src;

    }
}














