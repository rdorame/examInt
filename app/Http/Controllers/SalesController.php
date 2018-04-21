<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;
use App\Stock;
use App\Product;
use App\Sales;

class SalesController extends Controller
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
      $sales = Sales::with('info')->get();
      return view('sales.index', compact('sales'));
  }

  /**
   * Show the form for creating a sale resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $products = Product::orderBy('id', 'asc')->get();
      return view('sales.create', compact('products'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $stock = Stock::where('productID', '=', $request['productID'])->first();
      if ($stock === null) {
        $sales = Sales::orderBy('created_at', 'asc')->get();
        return view('sales.index', compact('sales'))->withInfo('Sale cancelled, there is no stock from that product');
      }

      $sale = Sales::where('productID', '=', $request['productID'])->first();
      if ($sale === null) {
       $sale = New Sales;
       $sale->productID = $request['productID'];

       if ($stock->quantityStored < $request['qty']) {
         $sales = Sales::orderBy('created_at', 'asc')->get();
         return view('sales.index', compact('sales'))->withInfo('Sale cancelled, there is no enough stock from that product');
       }

       $sale->quantitySold = $request['qty'];
       $sale->save();

       $sales = Sales::orderBy('created_at', 'asc')->get();
       return view('sales.index', compact('sales'))->withInfo('Sales created');
      }

      $sale->productID = $sale->productID;
      $oldQty = $sale->quantitySold;

      if ($stock->quantityStored < $request['qty'] + $oldQty) {
        $sales = Sales::with('info')->get();
        return view('sales.index', compact('sales'))->withInfo('Sale cancelled, there is no enough stock from that product to make a new purchase');
      }

      $sale->quantitySold = $request['qty'] + $oldQty;
      $sale->save();


      $sales = Sales::with('info')->get();
      return view('sales.index', compact('sales'));

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $sale = Sales::find($id);
      return view('sales.edit', compact('sale'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      $sale = Sales::find($id);
      $products = Product::orderBy('id', 'asc')->get();

      return view('sales.edit', compact('sale', 'products'));
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
    $sale = Sales::find($id);
    $sale->productID = $sale->productID;
    $sale->quantitySold = $request['qty'];
    $sale->save();

    $sales = Sales::with('info')->get();
    return view('sales.index', compact('sales'))->withInfo('Sales modified');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      $sale = Sales::find($id);
      $sale->delete();
      $sales = Sales::with('info')->get();
      return view('sales.index', compact('sales'))->withInfo('Sales deleted');
  }
}
