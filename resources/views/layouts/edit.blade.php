@extends('layouts.app')

@section('content')
    <div class="show">
        <div class="pull-left">
            <h2>商品情報編集画面</h2>
        </div>
        <form action="{{ route('products.update',$product->id )}}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

            <div class="form-group">
                <p>ID:{{ $product->id}}</p>
            </div>
            <div class="form-group">
                <label>商品名</lebel>
                <input type="text" name="product_name" value="{{ $product->product_name}}" class="form-control" placeholder="商品名">
                @error('product_name')
                    <span class ="error">商品名を入力してください</span>
                @enderror
            </div>
            <div class="form-group">
                <label>メーカー名</lebel>
                <select name="company_id" class="form-select">
                    <option>メーカー名を選択してください</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}"@if($company->id==$product->company_id) selected @endif>{{ $company->company_name }}</option>
                    @endforeach
                </select>
                @error('company_id')
                    <span class ="error">メーカー名を選択してください</span>
                @enderror
            </div>
            <div class="form-group">
                <label>価格</lebel>
                <input type="text" name="price" value="{{ $product->price }}" class="form-control" placeholder="価格">
                @error('price')
                    <span class ="error">価格を半角数字で入力してください</span>
                @enderror
            </div>
            <div class="form-group">
                <label>在庫数</lebel>
                <input type="text" name="stock" value="{{ $product->stock }}" class="form-control" placeholder="在庫数">
                @error('stock')
                    <span class ="error">在庫数を半角数字で入力してください</span>
                @enderror
            </div>
            <div class="form-group">
            <label>コメント</lebel>
                <textarea class="form-control" style="height:100px" name="comment" placeholder="コメント">{{ $product->comment }}</textarea>
            </div>
            <div class="form-group">
                <label>商品画像</lebel>
                <input type="file" name="img_path" class="form-control" placeholder="image">
                <img src="{{ asset('storage/app/public/images/'.$product->img_path) }}">
            </div>
            <div class="col-12 mb-2 mt-2">                
                <button type="submit" class="btn btn-primary">更新</button>
                <a class="btn btn-success" href="{{ route('products.show',$product->id )}}">戻る</a>
            </div>
        </form>      
    </div>
            
@endsection
    