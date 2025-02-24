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
            'productName' => 'required|string',
            'companyId'   => 'required',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|numeric|min:0',
            'comment'      => 'nullable|string',
            'img_path'     => 'nullable|image|mimes:jpg,jpeg,png,gif,svg',
        ];
    }

        /**
     * カスタムエラーメッセージを返す
     *
     * @return array
     */
    public function messages()
    {
        return [
            'productName.required' => '商品名は必須です。',
            'companyId.required' => 'メーカーは必須です。',
            'price.required' => '価格は必須です。',
            'price.numeric' => '価格は数値でなければなりません。',
            'stock.required' => '在庫数は必須です。',
            'stock.numeric' => '在庫数は数値でなければなりません。',
            'img_path.image' => '画像ファイルのみアップロード可能です。',
            'img_path.mimes' => 'jpg, jpeg, png, gif, svg形式の画像のみアップロードできます。',
        ];
    }
}
