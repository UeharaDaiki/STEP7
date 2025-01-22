@extends('layouts.app')


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

                        <div>
                            商品名
                            <input name="productName" type="text">
                        </div>
                        <div>
                            メーカー
                            <select name="companyId">
                                @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company-> company_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            価格
                            <input name="price" type="text">
                        </div>
                        <div>
                            在庫数
                            <input name="stock" type="text">
                        </div>
                        <div>
                            コメント
                            <input name="comment" type="text">
                        </div>
                        <div>
                            商品画像
                            <input name="image" type="file">
                        </div>
                        <div>
                            <input type="submit" value="新規登録">
                        </form>
                        <form action="{{ route('productList') }}" method="GET" enctype="multipart/form-data">
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
