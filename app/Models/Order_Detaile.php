<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Trans;

class Order_Detaile extends Model
{
    use HasFactory, Trans;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function product() {
        return $this->belongsTo(Product::class)->withDefault();
    }

    public function order() {
        return $this->belongsTo(Order::class)->withDefault();
    }
}
