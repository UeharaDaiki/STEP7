@extends('layouts.app')
@section('styles')
    <!-- このページでだけ適用するCSS -->
    <link rel="stylesheet" href="{{ asset('css/productDetail.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品情報詳細画面') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('productEdit',$product->id) }}" method="GET" enctype="multipart/form-data">
                        @csrf
                        <div class="flex">
                            <label class="item">ID</label>
                            <label class="input-item">{{ $product->id }}</label>
                        </div>
                        <div class="flex">
                            <label class="item">商品画像</label>
                            @if($product->img_path != null)
                                <img class="image" src="{{ asset($product->img_path) }}" alt="{{ asset($product->img_path) }}">
                            @else
                                
                            @endif
                        </div>
                        <div class="flex">
                            <label class="item">商品名</label>
                            <label class="input-item">{{ $product -> product_name }}</label>
                        </div>
                        <div class="flex">
                            <label class="item">メーカー</label>
                            @foreach($companies as $company)
                                @if($company -> id == $product -> company_id)
                                    <label class="input-item">{{ $company -> company_name }}</label>
                                @endif
                            @endforeach
                        </div>
                        <div class="flex">
                            <label class="item">価格</label>
                            <label class="input-item">￥{{ $product -> price }}</label>
                        </div>
                        <div class="flex">
                            <label class="item">在庫数</label>
                            <label class="input-item">{{ $product -> stock }}</label>
                        </div>
                        <div class="flex">
                            <label class="item">コメント</label>
                            <label class="input-item">{{ $product -> comment }}</label>
                        </div>
                        <div class="btn-container">
                            <input class="edit-btn" type="submit" value="編集">
                            <a href="{{ route('productList') }}" class="back-btn">
                                戻る
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
