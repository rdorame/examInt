@extends('layouts.app')
@section('content')

  <div class="container">
    <div class="row">
    <div class="col-md-9">
      <h1>Add new Product</h1>
          <div class="row">
            <div class="container">
              <form class="" action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <br>
                  <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" name="name" value="">
                  </div>
                  <div class="form-group">
                    <label for="min">Warehouse: </label>

                    <select class="form-group" name="wareID">
                      @foreach ($warehouses as $warehouse)
                        <option value="{{ $warehouse->id }}"> {{ $warehouse->name }} </option>

                      @endforeach

                    </select>
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="min">Min Qty: </label>
                    <input type="text" name="min" value="">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="max">Max Qty: </label>
                    <input type="text" name="max" value="">
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
