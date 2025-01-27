@extends('layouts.app')
@section('styles')
    <!-- このページでだけ適用するCSS -->
    <link rel="stylesheet" href="{{ asset('css/productRegist.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品新規登録画面') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('regist') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="flex">
                            <label class="item">商品名<label class="required">*</label></label>
                            <input class="input-item" name="productName" type="text">
                        </div>
                        <div class="flex">
                            <label class="item">メーカー<label class="required">*</label></label>
                            <select class="input-item" name="companyId">
                                @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company-> company_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex">
                            <label class="item">価格<label class="required">*</label></label>
                            <input class="input-item" name="price" type="text">
                        </div>
                        <div class="flex">
                            <label class="item">在庫数<label class="required">*</label></label>
                            <input class="input-item" name="stock" type="text">
                        </div>
                        <div class="flex">
                            <label class="item">コメント</label>
                            <input class="input-item" name="comment" type="text">
                        </div>
                        <div class="flex">
                            <label class="item">商品画像</label>
                            <input class="input-item" name="image" type="file">
                        </div>
                            <div class="btn-container">
                                <input class="regist-btn" type="submit" value="新規登録">
                                <a href="{{ route('productList') }}" class="back-btn">
                                    戻る
                                </a>
                            </div>
                        </form>
                        <!--form action="{{ route('productList') }}" method="GET" enctype="multipart/form-data">
                        @csrf
                        <div class="btn-container">
                            <input class="back-btn" type="submit" value="戻る">
                        </div>
                        </form-->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
