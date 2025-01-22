<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            
            'productName' => 'required|string|max:255', // 商品名のバリデーション
            'companyId'   => 'required|exists:companies,id', // メーカーIDがcompaniesテーブルに存在するかチェック
            'price'        => 'required|min:0', // 価格のバリデーション
            'stock'        => 'required|integer|min:0', // 在庫数のバリデーション
            'comment'      => 'nullable|string|max:255', // コメントのバリデーション
            
        ];
    }
}
