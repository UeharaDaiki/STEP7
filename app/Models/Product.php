<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    public function registProduct($data)
    {
        DB::table('products')->insert([
            'company_id' => $data->companyId,
            'product_name' => $data->productName,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $data->image
     
        ]);
    }

    public function updateProduct($data,$id){
    // 更新するデータを準備
    $updateData = [
        'company_id' => $data->companyId,
        'product_name' => $data->productName,
        'price' => $data->price,
        'stock' => $data->stock,
        'comment' => $data->comment,
    ];
    // 画像がnullでない場合のみimg_pathを追加
    if ($data->image !== null) {
        $updateData['img_path'] = $data->image;
    }
    // 更新処理
    DB::table('products')->where('id', $id)->update($updateData);
    }



}
