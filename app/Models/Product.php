<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    public function registProduct($data){
        //dd($data -> all());
        DB::table('products')->insert([
            'company_id' => $data->companyId, // inputメソッドを使用
            'product_name' => $data->productName,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $data->image  // 必要に応じて追加
     
        ]);
    }

    public function updateProduct($data,$id){
        DB::table('products')->where('id', $id)->update([
            'company_id' => $data->companyId, // inputメソッドを使用
            'product_name' => $data->productName,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $data->image  // 画像を更新（必要に応じて）
        ]);
    }



}
