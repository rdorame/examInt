@extends('layouts.app')
@section('content')

  <div class="container">
    <div class="row">
    <div class="col-md-9">
      <h1>New sale</h1>
          <div class="row">
            <div class="container">
              <form class="" action="{{route('sales.store')}}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <br>
                  <div class="form-group">
                    <label for="min">Product: </label>

                    <select class="form-group" name="productID">
                      @foreach ($products as $product)
                        <option value="{{ $product->id }}"> {{ $product->name }} </option>

                      @endforeach

                    </select>
                  </div>
                  <div class="form-group">
                    <label for="qty">Qty to sell: </label>
                    <input type="text" name="qty" value="">
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
