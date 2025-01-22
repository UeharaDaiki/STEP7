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
    /*
    public function index()
    {
        $products = Product::all();
        $companies = company::all();
        return view('productList',compact('products','companies'));
    }
        */
        /*
    public function index(Request $request)
{
    // セッションから商品情報を取得
    // セッションに商品情報があれば、それを使用
    //$products = session('products', Product::paginate(10)); // デフォルトでは全商品を表示
    $products = Product::paginate(10);
    //$products = session('products', Product::paginate(10));
    $companies = company::all(); // 会社情報を取得

    // ビューにデータを渡して表示
    return view('productList', compact('products', 'companies'));
}
    */
    public function index(Request $request)
{
    // 検索条件を受け取る
    $searchProductName = $request->input('searchProductName');
    $searchCompanyId = $request->input('searchCompanyId');
    
    // 商品のクエリビルダーを作成
    $query = Product::query();
    
    // 検索条件があればクエリに追加
    if ($searchProductName) {
        $query->where('product_name', 'like', '%' . $searchProductName . '%');
    }

    if ($searchCompanyId) {
        $query->where('company_id', $searchCompanyId);
    }

    // 絞り込んだ商品を取得
    $products = $query->paginate(10);
    
    // 会社情報を全て取得
    $companies = company::all();

    return view('productList', compact('products', 'companies', 'searchProductName', 'searchCompanyId'));
}


    public function delete($id)
    {
        $product = Product::find($id);
    
        if ($product) {
            $product->delete();  // 商品を削除
            // 削除後にリダイレクトしたいURLを返す
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
    }

    public function search(Request $request)
{
    // 検索条件を受け取る
    $searchProductName = $request->input('searchProductName');
    $searchCompanyId = $request->input('searchCompanyId');
    
    // 商品のクエリビルダーを作成
    $query = Product::query();
    
    // 検索条件があればクエリに追加
    if ($searchProductName) {
        $query->where('product_name', 'like', '%' . $searchProductName . '%');
    }

    if ($searchCompanyId) {
        $query->where('company_id', $searchCompanyId);
    }

    // 絞り込んだ商品を取得
    $products = $query->paginate(10);
    
    // 会社情報を全て取得
    $companies = company::all();

    // AJAXでのリクエストであれば、部分的に更新
    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'productList' => view('productList', compact('products', 'companies'))->render(),
            'pagination' => (string) $products->links('pagination::bootstrap-5'),
        ]);
    }

    // 通常のリダイレクト
    return redirect()->route('productList', [
        'searchProductName' => $searchProductName,
        'searchCompanyId' => $searchCompanyId,
    ]);
}
    
}
