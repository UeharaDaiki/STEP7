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
        return view('productRegist', compact('companies'));
    }

    public function regist(ProductRequest $request){
        if($request->file('image') != null){
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $image->storeAs('public/images', $fileName);
            $imagePath = 'storage/images/' . $fileName;
            $request->merge(['image' => $imagePath]);
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
