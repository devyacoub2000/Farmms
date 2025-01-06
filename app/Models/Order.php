<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Trans;

class Order extends Model
{
    use HasFactory, Trans;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class)->withDefault();
    }
    public function order_detailes() {
        return $this->hasMany(Order_Detaile::class);
    }
}
