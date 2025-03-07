<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sales;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    //
    public function purchase(Request $request){
        try{
            DB::beginTransaction();
            $productId = $request->input('product_id');
            $quantity = $request->input('quantity',1);

            $product = Product::find($productId);

            if(!$product){
                return response()->json(['message' => '商品が存在しません'],404);
            }
            if($product->stock < $quantity){
                return response()->json(['message' => '商品が在庫不足です'],400);
            }
            $product->stock-=$quantity;
            $product->save();

            $sale = new Sales;
            $sale->product_id = $productId;
            $sale->save();

            DB::commit();

            return response()->json(['message' => '購入成功']);
        }catch(\Exception $e){
            DB::rollback();
            \Log::error('Product registration failed: ' . $e->getMessage());
            return back()->with('status', 'エラーが発生しました');
        }

    }
}
