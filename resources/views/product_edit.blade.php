@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/productEdit.css') }}">
@endsection


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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('edit',$product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="flex flex-id">
                            <label class="item">ID.</label>
                            <label class="input-item input-id">{{$product->id}}</label>
                        </div>
                        <div class="flex">
                            <label class="item">商品名<label class="required">*</label></label>
                            <input class="input-item" type="text" name="productName" value='{{$product->product_name}}'>
                        </div>
                        <div class="flex">
                        <label class="item">メーカー<label class="required">*</label></label>
                            <select class="input-item" name="companyId">
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" @if($company->id == $product->company_id) selected @endif>
                                        {{ $company->company_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex">
                            <label class="item">価格<label class="required">*</label></label>
                            <input class="input-item" type="text" name="price" value='{{$product->price}}'>
                        </div>
                        <div class="flex">
                            <label class="item">在庫数<label class="required">*</label></label>
                            <input class="input-item" type="text" name="stock" value='{{$product->stock}}'>
                        </div>
                        <div class="flex">
                            <label class="item">コメント</label>
                            <input class="input-item" type="text" name="comment" value='{{$product->comment}}'>
                        </div>
                        <div class="flex">
                            <label class="item">商品画像</label>
                            <input class="input-item" type="file" name="image">
                        </div>
                        <div class="btn-container">
                            <input class="edit-btn" type="submit" value="更新">
                            <a href="{{ route('productDetail',$product->id) }}" class="back-btn">
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