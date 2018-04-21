@extends('layouts.app')
@section('content')

  <div class="container">
    <div class="row">
    <div class="col-md-9">
      <h1>Edit Warehouse</h1>
          <div class="row">
            <div class="container">
              <form class="" action="{{route('warehouses.update', $warehouse->id)}}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  {{method_field('put')}}
                  <br>
                  <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" name="name" value="{{ $warehouse->name }}">
                  </div>
                  <div class="form-group">
                    <label for="min">Min Qty: </label>
                    <input type="text" name="min" value="{{ $warehouse->min }}">
                  </div>
                  <div class="form-group">
                    <label for="max">Max Qty: </label>
                    <input type="text" name="max" value="{{ $warehouse->max }}">
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
