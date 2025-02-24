<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;

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

        return view('product_edit',compact('companies','product'));
    }

    public function edit(ProductRequest $request, $id)
{
    try{
        // 商品画像に変更があれば更新
        if($request->file('image') != null){
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $image->storeAs('public/images', $fileName);
            $imagePath = 'storage/images/' . $fileName;
            $request->image = $imagePath;
        }
        // 商品情報を更新
        $model = new Product();
        $model->updateProduct($request,$id);

        return redirect()->route('productDetail', ['id' => $id])->with('status', '商品情報が更新されました');
    }catch(\Exception $e){
        DB::rollback();
        \Log::error('Product registration failed: ' . $e->getMessage());
        return back()->with('status', '商品が登録できませんでした');
    }
}
}
