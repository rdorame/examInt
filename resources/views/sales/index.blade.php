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
      Sales  <a href="{{ url('sales/create') }}" class="btn btn-success">+</a>
    </h1>
    <table>
      <thead>
        <tr>
          <th scope="col">Product</th>
          <th scope="col">Qty</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($sales as $sale)
          <tr>
            <td data-label="pID"> {{ $sale->info->name }} </td>
            <td data-label="qty">{{ $sale->quantitySold }}</td>
            <td>
              <a href="{{ route('sales.edit', $sale->id)}}" class="btn btn-info">Edit</a>
              <form class="" action="{{ route('sales.destroy', $sale->id)}}" method="post">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button class="btn btn-sm btn-danger">Delete</a>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
