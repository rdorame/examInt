@extends('layouts.app')
@section('content')

  <div class="container">
    <div class="row">
    <div class="col-md-9">
      <h1>Edit Stock</h1>
          <div class="row">
            <div class="container">
              <form class="" action="{{route('sales.update', $sale->id)}}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  {{method_field('put')}}
                  <br>
                  <div class="form-group">
                    <label for="min">Product: </label>
                    {{ $stock->productID }}
                  </div>
                  <div class="form-group">
                    <label for="name">Qty to store: </label>
                    <input type="text" name="name" value="{{ $stock->quantityStored }}">
                  </div>
                  <br>

                  <button type="submit" name="button" class="btn btn-success">Submit</button>
              </form>

            </div>
          </div>
    </div>
  </div>
</div>

@endsection
