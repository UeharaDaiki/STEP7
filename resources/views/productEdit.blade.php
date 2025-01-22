@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品編集画面') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('edit',$product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div>
                            ID.
                            <label>{{$product->id}}</label>
                        </div>

                        <div>
                            商品名
                            <input type="text" name="productName" value='{{$product->product_name}}'>
                        </div>
                        <div>
                            メーカー
                            <select name="companyId">
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" @if($company->id == $product->company_id) selected @endif>
                                        {{ $company->company_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            価格
                            <input type="text" name="price" value='{{$product->price}}'>
                        </div>
                        <div>
                            在庫数
                            <input type="text" name="stock" value='{{$product->stock}}'>
                        </div>
                        <div>
                            コメント
                            <input type="text" name="comment" value='{{$product->comment}}'>
                        </div>
                        <div>
                            商品画像
                            <input type="file" name="image" value='{{$product->img_path}}'>
                        </div>
                        <div>
                        <form action="{{ route('edit',$product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <input type="submit" value="更新">
                        </form>
                        <form action="{{ route('productDetail',$product->id) }}" method="GET" enctype="multipart/form-data">
                        @csrf
                            <input type="submit" value="戻る">
                        </form>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection