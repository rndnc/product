@extends('layouts.app')

@section('content')
    <div class="show">
        <div class="col-lg-12 margin-tb">           
            <h2>商品情報詳細画面</h2>
        </div>
        <table>	
			<tr><th>id</th><td>：</td><td>{{ $product->id}}</td></tr>
			<tr><th>商品画像</th><td>：</td><td><img src="{{ asset('storage/app/public/images/'.$product->img_path) }}"></td></tr></td></tr>
			<tr><th>商品名</th><td>：</td><td>{{ $product->product_name }}</td></tr>
            <tr><th>メーカー名</th><td>：</td><td>@foreach ($companies as $company)
                                                    @if($company->id==$product->company_id) {{ $company->company_name }} @endif
                                                    @endforeach</td></tr>
            <tr><th>価格</th><td>：</td><td>{{ $product->price }}円</td></tr>
            <tr><th>在庫数</th><td>：</td><td>{{ $product->stock }}</td></tr>
            <tr><th>コメント</th><td>：</td><td>{{ $product->comment }}</td></tr>
		</table>
    </div>
    <div class="pull-right">
        <a class="btn btn-success" href="{{ url('/products')}}">戻る</a>
        <a class="btn btn-primary" href="{{ route('products.edit',$product->id)}}">編集</a> 
    </div>
    
@endsection
    