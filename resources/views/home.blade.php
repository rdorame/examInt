@extends('layouts.app')
<style media="screen">
  table {
    width: 100%;
  }

  th, td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
  }

  tr:hover {background-color: #f5f5f5;}
</style>
@section('content')
  <div class="container">
    <h1>
      Dashboard
    </h1>
    <table>
      <thead>
        <tr>
          <th scope="col">Product Name</th>
          <th scope="col">On Stock</th>
          <th scope="col">Sold</th>
          <th scope="col">Total</th>
          <th scope="col">Warehouse</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($products as $product)
          <?php
            $sold = DB::table('sales')->where('productID', $product->id)->first();
            $onStock = $product->stock->quantityStored - $sold->quantitySold;
          ?>
          @if ($onStock < $product->min )
            <tr style="background-color: red; color: white;">
          @elseif ($onStock > $product->min && $onStock < $product->max )
            <tr style="background-color: yellow; color: black;">
          @elseif($onStock == $product->max)
            <tr style="background-color: green; color: white;">
          @endif

            <td data-label="name"> {{ $product->name }} </td>
            <td data-label="stock">
            <?php
              echo $onStock;
            ?>
            </td>
            <td data-label="sold">
              <?php
                $sold = DB::table('sales')->where('productID', $product->id)->first();
                echo $sold->quantitySold;
              ?>
            </td>
            <td data-label="total"> {{ $product->stock->quantityStored }} </td>
            <td data-label="warehouse"> {{ $product->info->name }} </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="col-sm-12" style="width:40%; margin-left: 30%; margin-right: 30%; margin-top: 100px">
      <img src="img/legend.png" alt="" width="100%">
      <br>
      <h3>White means that stock is more than max</h3>
    </div>
  </div>
@endsection
