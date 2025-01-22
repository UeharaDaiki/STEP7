<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;

class ProductEditController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
        $companies = Company::all();
        $product = Product::find($id);
        return view('productEdit',compact('companies','product'));
    }

    public function edit(Request $request, $id)
{
    //$product = Product::find($id);
    // 商品情報を更新
    $model = new Product();
    $model->updateProduct($request,$id);

    //$product->update($request->all(),$id);
    return redirect()->route('productDetail', ['id' => $id])->with('status', '商品情報が更新されました');
}
}
