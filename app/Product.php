<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sales;
use App\Stock;
use App\Warehouse;

class Product extends Model
{

  public function info() {
    return $this->belongsTo(Warehouse::class, 'warehouseID');
  }

  public function stock() {
    return $this->belongsTo(Stock::class, 'id');
  }

  public function sales() {
    return $this->belongsTo(Sales::class, 'id');
  }


}
