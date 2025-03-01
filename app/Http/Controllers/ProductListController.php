<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\company;

class ProductListController extends Controller
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
    public function index(Request $request)
    {
        // 検索条件を受け取る
        $searchProductName = $request->input('searchProductName');
        $searchCompanyId = $request->input('searchCompanyId');
        $maxPrice = $request->input('maxPrice');
        $minPrice = $request->input('minPrice');
        $maxStock = $request->input('maxStock');
        $minStock = $request->input('minStock');

        
        $query = Product::query();
        // 検索条件があればクエリに追加
        if ($searchProductName) {
            // 商品名検索欄に文字が入力されていたら絞り込み
            $query->where('product_name', 'like', '%' . $searchProductName . '%');
        }
        if ($searchCompanyId) {
            // メーカー名が入力されていたら絞り込み
            $query->where('company_id', $searchCompanyId);
        }
        if($maxPrice!=null || $minPrice!=null){
            if($maxPrice!=null && $minPrice!=null){
                //どちらの入力がある
                $query->whereBetween('price',[$minPrice,$maxPrice]);
                //dd($minPrice);
            }elseif($maxPrice!=null){
                //上限だけ入力がある
                $query->where('price','<=',$maxPrice);
            }elseif($minPrice!=null){
                //下限だけ入力がある
                $query->where('price','>=',$minPrice);
            }
        }
        if($maxStock!=null || $minStock!=null){
            if($maxStock!=null && $minStock!=null){
                //どちらの入力がある
                $query->whereBetween('stock',[$minStock,$maxStock]);
                //dd($minPrice);
            }elseif($maxStock!=null){
                //上限だけ入力がある
                $query->where('stock','<=',$maxStock);
            }elseif($minStock!=null){
                //下限だけ入力がある
                $query->where('stock','>=',$minStock);
            }
        }



        // 絞り込んだ商品を取得
        $products = $query->paginate(10);
        
        // 会社情報を全て取得
        $companies = company::all();

        return view('product_list', compact('products', 'companies', 'searchProductName', 'searchCompanyId','maxPrice','minPrice'));
    }

    public function delete($id)
    {
        try {
            $product = Product::find($id);
    
            if ($product) {
                // 商品をDBから削除
                $product->delete();
                return response()->json([
                    'success' => true,
                    'message' => '商品が削除されました。',
                    'redirect_url' => route('productList')  // 商品一覧ページにリダイレクト
                ]);
            }
    
            return response()->json([
                'success' => false,
                'message' => '商品が見つかりません。',
            ]);
        } catch (\Exception $e) {
            \Log::error('商品削除エラー: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => '商品削除中にエラーが発生しました。後ほどもう一度試してください。',
            ]);
        }
    }
    
    public function search(Request $request)
    {
        //dd($request);
        // 検索条件を受け取る
        $searchProductName = $request->input('searchProductName');
        $searchCompanyId = $request->input('searchCompanyId');
        $maxPrice = $request->input('maxPrice');
        $minPrice = $request->input('minPrice');
        $maxStock = $request->input('maxStock');
        $minStock = $request->input('minStock');
        
        $query = Product::query();
        // 検索条件があればクエリに追加
        if ($searchProductName) {
            // 商品名検索欄に文字が入力されていたら絞り込み
            $query->where('product_name', 'like', '%' . $searchProductName . '%');
        }
        if ($searchCompanyId) {
            // メーカー名が入力されていたら絞り込み
            $query->where('company_id', $searchCompanyId);
        }

       // $minPrice = (float) $minPrice;
        //$maxPrice = (float) $maxPrice;        
        if($maxPrice!=null || $minPrice!=null){
            if($maxPrice!=null && $minPrice!=null){
                //どちらの入力がある
                $query->whereBetween('price',[$minPrice,$maxPrice]);
                //dd($query->toSql());
                //dd($query->toSql(), $query->getBindings());


                //dd($minPrice,$maxPrice);
            }elseif($maxPrice!=null){
                //上限だけ入力がある
                $query->where('price','<=',$maxPrice);
            }elseif($minPrice!=null){
                //下限だけ入力がある
                $query->where('price','>=',$minPrice);
            }
        }
        if($maxStock!=null || $minStock!=null){
            if($maxStock!=null && $minStock!=null){
                //どちらの入力がある
                $query->whereBetween('stock',[$minStock,$maxStock]);
                //dd($query->toSql(), $query->getBindings());
                //dd($minPrice);
            }elseif($maxStock!=null){
                //上限だけ入力がある
                $query->where('stock','<=',$maxStock);
            }elseif($minStock!=null){
                //下限だけ入力がある
                $query->where('stock','>=',$minStock);
            }
        }


        // 絞り込んだ商品を取得
        $products = $query->paginate(10);
        
        // 会社情報を全て取得
        $companies = company::all();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'productList' => view('product_list', compact('products', 'companies'))->render(),
                'pagination' => (string) $products->links('pagination::bootstrap-5'),
            ]);
        }

        return redirect()->route('productList', [
            'searchProductName' => $searchProductName,
            'searchCompanyId' => $searchCompanyId,
            'maxPrice' => $maxPrice,
            'minPrice' => $minPrice,
            'maxStock' => $maxStock,
            'minStock' => $minStock,

        ]);
    }
    
}
