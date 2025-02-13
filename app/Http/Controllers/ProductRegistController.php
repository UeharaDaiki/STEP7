<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

class ProductRegistController extends Controller
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
    public function index()
    {
        $companies = Company::all();
        return view('product_regist', compact('companies'));
    }

    public function regist(ProductRequest $request)
    {
        // 画像がnullでなければ登録の処理
        if($request->file('image') != null){
            // リクエストからimageを取得
            $image = $request->file('image');
            // ファイル名を取得
            $fileName = $image->getClientOriginalName();
            // ファイルに保存処理
            $image->storeAs('public/images', $fileName);
            // DBに登録する用のpathを用意
            $imagePath = 'storage/images/' . $fileName;
            //リクエストに再代入
            $request->image = $imagePath;
        }
        DB::beginTransaction();

        try{
            $model = new Product();
            $model->registProduct($request);
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            \Log::error('Product registration failed: ' . $e->getMessage());
            return back()->with('status', '商品が登録できませんでした');

        }
        return redirect(route('productRegist')) -> with('status', '商品が登録されました');
    }
}
