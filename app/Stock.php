<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;


class Stock extends Model
{
  public function info() {
    return $this->belongsTo(Product::class, 'productID');
  }
}
