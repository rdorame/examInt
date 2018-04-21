<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Product;
use App\Stock;
use App\Sales;
use App\Warehouse;

class StockController extends Controller
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
      $stocks = Stock::with('info')->get();
      return view('stocks.index', compact('stocks'));
  }

  /**
   * Show the form for creating a stock resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $products = Product::orderBy('id', 'asc')->get();
      return view('stocks.create', compact('products'));
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
       // If the product hasn't stock yet
       $stock = New Stock;
       $stock->productID = $request['productID'];
       $stock->quantityStored = $request['qty'];

       $product = DB::table('products')->where('id', $request['productID'])->first();

       if ($stock->quantityStored > $product->max) {
         $stocks = Stock::orderBy('created_at', 'asc')->get();
         return view('stocks.index', compact('stocks'))->withInfo('Qty is bigger than max of the product');
       }

       $stock->save();

       $stocks = Stock::orderBy('created_at', 'asc')->get();
       return view('stocks.index', compact('stocks'))->withInfo('Stock created');
      }
      // If the product has stock we add the new amount to the old one
      $stock = Stock::find($request['productID']);
      $oldQty = $stock->quantityStored;
      $stock->quantityStored = $request['qty'] + $oldQty;

      $product = Product::where('id', '=', $request['productID'])->get();
      $sale = Sales::where('productID', '=', $request['productID'])->get();


      $stock->save();


      $stocks = Stock::with('info')->get();
      return view('stocks.index', compact('stocks'))->withInfo('Stock created');

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $stock = Stock::find($id);
      return view('stocks.edit', compact('stock'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      $stock = Stock::find($id);
      $products = Product::orderBy('id', 'asc')->get();

      return view('stocks.edit', compact('stock', 'products'));
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
    $stock = Stock::find($id);
    $stock->productID = $stock->productID;
    $stock->quantityStored = $request['qty'];
    $stock->save();

    $stocks = Stock::with('info')->get();
    return view('stocks.index', compact('stocks'))->withInfo('Stock modified');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      $stock = Stock::find($id);
      $stock->delete();
      $stocks = Stock::with('info')->get();
      return view('stocks.index', compact('stocks'))->withInfo('Stock deleted');
  }
}
