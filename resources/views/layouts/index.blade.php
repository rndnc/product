@extends('layouts.app')

@section('content')
    <div class="show">
        <h2>商品情報一覧画面</h2>
    </div>
    <div class="show">
        <form method="get" action="{{ route('products.search')}}" class="form-inline">
            <div class="form-group">
                <input id="keyword" type="text" name="keyword" class="form-control" value="{{ $keyword }}" placeholder="検索キーワード">
            </div>
            <div class="form-group">
                <select id="companyId" method="get" action="{{ route('products.search')}}"class="form-select" name="companyId" title="メーカーを選択してください">
                    <option value="">メーカーを選択してください</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id}}">{{ $company->company_name}}</option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>商品価格</label>
                <input id="jougenPrice" type="number" name="jougenPrice" class="form-control" value="{{ $jougenPrice }}" placeholder="上限">
            </div>
            <div class="form-group">
                <input id="kagenPrice" type="number" name="kagenPrice" class="form-control" value="{{ $kagenPrice }}" placeholder="下限">
            </div>
            <div class="form-group">
                <label>在庫</label>
                <input id="jougenStock" type="number" name="jougenStock" class="form-control" value="{{ $jougenStock }}"placeholder="上限">
            </div>
            <div class="form-group">
                <input id="kagenStock" type="number" name="kagenStock" class="form-control" value="{{ $kagenPrice }}" placeholder="下限">
            </div>
            <input type="submit" value="検索" class="btn btn-info" id="search-btn">
        </form>
    </div>

    <div class="row">
        <table class="table table-borderd" id="table-1">
            <tr>
                <th>
                    <button class="btn sortable-link" data-column="id" data-direction="asc" type="button">ID</button>
                </th>
                <th>
                <button class="btn sortable" >商品画像</button>
                </th>
                <th>
                    <button class="btn sortable-link" data-column="product_name" data-direction="asc" type="button">商品名</button>
                </th>
                <th>
                    <button class="btn sortable-link" data-column="price" data-direction="asc" type="button">価格</button>
                </th>
                <th>
                    <button class="btn sortable-link" data-column="stock" data-direction="asc" type="button">在庫</button>
                </th>
                <th>
                    <button class="btn sortable-link" data-column="company_id" data-direction="asc" type="button">メーカー名</button>
                </th>
                <th> 
                    <a class="btn btn-primary" href="{{ route('products.create')}}">新規登録</a>
                </th>
            </tr>
            </table>
            <table class="table table-borderd" id="table-2">
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id}}</td>
                <td><img alt="" src="{{ asset('storage/app/public/images/'.$product->img_path)}}"></td>
                <td>{{ $product->product_name}}</td>
                <td>{{ $product->price}}円</td>
                <td>{{ $product->stock}}個</td>
                <td>{{ $product->company_name }}<td>
                    <form action="{{ route('products.destroy',$product->id)}}" method="POST">
                        <a class="btn btn-info" href="{{ route('products.show',['id'=>$product->id] )}}">詳細</a>
                        @csrf
                        @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick='return confirm("削除しますか？");'>削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    {{ $products->links() }}

@endsection
    