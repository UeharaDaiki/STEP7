@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">{{ __('商品一覧画面') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div>
                        <form action="{{ route('search') }}" method="POST">
                            @csrf
                            <input name="searchProductName" type="text" value="{{ request('searchProductName') }}" placeholder="検索キーワード">
                            <select name="searchCompanyId">
                                <option value="" disabled {{ request('searchCompanyId') ? '' : 'selected' }}>メーカー名</option>
                                <option value="" {{ request('searchCompanyId') == '' && !request('searchProductName') ? 'selected' : '' }}>選択しない</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" 
                                        {{ request('searchCompanyId') == $company->id ? 'selected' : '' }}>
                                        {{ $company->company_name }}
                                    </option>
                                @endforeach
                            </select>
                            <input class="search-btn" type="submit" value="検索">
                        </form>
                    </div>

                    <div>
                        <table class="product-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>商品画像</th>
                                    <th>商品名</th>
                                    <th>価格</th>
                                    <th>在庫数</th>
                                    <th>メーカー名</th>
                                    <form action="{{ route('productRegist') }}" method="GET">
                                        <th style="width: 30px;"><input type="submit" class="regist-btn" value="新規登録"></th>
                                    </form>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                
                                    <tr>
                                        <td>{{ $product -> id}}</td>
                                        @if($product->img_path != null)
                                        <td>
                                            <img src="{{ asset($product->img_path) }}" alt="{{ asset($product->img_path) }}">
                                        </td>
                                        @else
                                        <td></td>
                                        @endif
                                        <td>{{$product->product_name}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->stock}}</td>
                                        @foreach($companies as $company)
                                            @if($company -> id == $product -> company_id)
                                                <td>{{ $company -> company_name }}</td>
                                            @endif
                                        @endforeach
                                        <td>
                                            <form action="{{ route('productDetail',['id'=>$product->id]) }}" method="GET">
                                                @csrf
                                                <input class="detail-btn" type="submit" value="詳細">
                                            </form>
                                            <form action="{{ route('delete',['id'=>$product->id]) }}" method="POST">
                                                @csrf
                                                <!--@method('DELETE')-->
                                                <input type="submit" class="delete-btn" data-id="{{ $product->id }}" name="delete" value="削除">
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                        {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
                                </div>

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('js/productDelete.js') }}"></script>
@endpush