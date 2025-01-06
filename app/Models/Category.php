<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Trans;

class Category extends Model
{
    use HasFactory, Trans;

    protected $guarded = [];

    public function products() {
        return $this->hasMany(Product::class);
    }
}
