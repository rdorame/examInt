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
      Warehouses <a href="{{ url('warehouses/create') }}" class="btn btn-success">+</a>
    </h1>
    <table>
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Min Qty</th>
          <th scope="col">Max Qty</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($warehouses as $warehouse)
          <tr>
            <td data-label="responsable"> {{ $warehouse->name }} </td>
            <td data-label="client">{{ $warehouse->min }}</td>
            <td data-label="st">{{ $warehouse->max }}</td>
            <td>
              <a href="{{ route('warehouses.edit', $warehouse->id)}}" class="btn btn-info">Edit</a>
              <form class="" action="{{ route('warehouses.destroy', $warehouse->id)}}" method="post">
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
