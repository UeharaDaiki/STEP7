@extends('layouts.app')


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
                        <div>
                            ID
                            <label>{{ $product->id }}</label>
                        </div>
                        <div>
                            商品画像
                            @if($product->img_path != null)
                                <img src="{{ asset($product->img_path) }}" alt="{{ asset($product->img_path) }}">
                            @else
                                <label></label>
                            @endif

                        </div>
                        <div>
                            商品名
                            <label>{{ $product -> product_name }}</label>
                        </div>
                        <div>
                            メーカー
                            @foreach($companies as $company)
                                @if($company -> id == $product -> company_id)
                                    <label>{{ $company -> company_name }}</label>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            価格
                            <label>￥{{ $product -> price }}</label>
                        </div>
                        <div>
                            在庫数
                            <label>{{ $product -> stock }}</label>
                        </div>
                        <div>
                            コメント
                            <textarea></textarea>
                        </div>
                        <div>
                        <form action="{{ route('productEdit',$product->id) }}" method="GET" enctype="multipart/form-data">
                            <input type="submit" value="編集">
                        </form>
                        <form action="{{ route('productList') }}" method="GET" enctype="multipart/form-data">
                            <input type="submit" value="戻る">
                        </form>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
