<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;

class WarehouseController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $warehouses = Warehouse::orderBy('created_at', 'asc')->get();
      return view('warehouses.index', compact('warehouses'));
  }

  /**
   * Show the form for creating a warehouse resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('warehouses.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $warehouse = New Warehouse;
      $warehouse->name = $request['name'];
      $warehouse->min = $request['min'];
      $warehouse->max = $request['max'];

      $warehouse->save();

      $warehouses = Warehouse::orderBy('created_at', 'asc')->get();
      return view('warehouses.index', compact('warehouses'))->withInfo('Warehouse created');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $warehouse = Warehouse::find($id);
      return view('warehouses.edit', compact('warehouse'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      $warehouse = Warehouse::find($id);

      return view('warehouses.edit', compact('warehouse'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $warehouse = Warehouse::find($id);
    $warehouse->name = $request['name'];
    $warehouse->min = $request['min'];
    $warehouse->max = $request['max'];
    $warehouse->save();

    $warehouses = Warehouse::paginate(10);
    return view('warehouses.index', compact('warehouses'))->withInfo('Warehouse modified');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      $warehouse = Warehouse::find($id);
      $warehouse->delete();
      $warehouses = Warehouse::paginate(10);
      return view('warehouses.index', compact('warehouses'))->withInfo('Warehouse deleted');
  }
}
