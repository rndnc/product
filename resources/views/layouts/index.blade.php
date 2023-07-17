@extends('layouts.app')

@section('content')
    <div class="show">
        <h2>商品情報一覧画面</h2>
    </div>
    <div class="show">
        <form method="get" action="{{ route('products.index')}}" class="form-inline">
            <div class="form-group">
                <input type="text" name="keyword" class="form-control" value="{{ $keyword }}" placeholder="検索キーワード">
            </div>
            <div class="form-group">
                <select  method="get" action="{{ route('products.index')}}"class="form-select" name="companyId">
                    <option>メーカーを選択してください</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id}}">{{ $company->company_name}}</option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="検索" class="btn btn-info">
            </div>
        </form>
    </div>

    <div class="row">
        <table class="table table-borderd">
            <tr>
                <th>id</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
                <th> 
                    <a class="btn btn-primary" href="{{ route('products.create')}}">新規登録</a>
                </th>
            </tr>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id}}</td>
                <td><img src="storage/app/public/images/{{ $product->img_path }}"></td>
                <td>{{ $product->product_name}}</td>
                <td>{{ $product->price}}円</td>
                <td>{{ $product->stock}}個</td>
                <td>
                    @foreach ($companies as $company)
                        @if($company->id==$product->company_id) {{ $company->company_name }} @endif
                    @endforeach
                <td>
                    <form action="{{ route('products.destroy',$product->id)}}" method="POST">
                        <a class="btn btn-info" href="{{ route('products.show',$product->id )}}">詳細</a>
                        @csrf
                        @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick='return confirm("削除しますか？");'>削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

@endsection
    