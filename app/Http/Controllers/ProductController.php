<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Warehouse;

class ProductController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $products = Product::orderBy('created_at', 'asc')->get();
      return view('products.index', compact('products'));
  }

  /**
   * Show the form for creating a product resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $warehouses = Warehouse::orderBy('name', 'asc')->get();
      return view('products.create', compact('warehouses'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $product = New Product;
      $product->name = $request['name'];
      $product->warehouseID = $request['wareID'];
      $product->max = $request['max'];
      $product->min = $request['min'];


      $product->save();

      $products = Product::orderBy('created_at', 'asc')->get();
      return view('products.index', compact('products'))->withInfo('Product created');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $product = Product::find($id);
      return view('products.edit', compact('product'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      $product = Product::find($id);
      $warehouses = Warehouse::orderBy('name', 'asc')->get();

      return view('products.edit', compact('product', 'warehouses'));
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
    $product = Product::find($id);
    $product->name = $request['name'];
    $product->warehouseID = $request['wareID'];
    $product->max = $request['max'];
    $product->min = $request['min'];
    $product->save();

    $products = Product::paginate(10);
    return view('products.index', compact('products'))->withInfo('Product modified');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      $product = Product::find($id);
      $product->delete();
      $products = Product::paginate(10);
      return view('products.index', compact('products'))->withInfo('Product deleted');
  }
}
