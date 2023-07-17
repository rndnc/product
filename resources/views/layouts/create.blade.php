@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="pull-left">
            <h2>商品登録フォーム</h2>
        </div>
        <form action="{{ route('products.regist') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="show">
                <div class="form-group">
                    <label>商品名</lebel>
                    <input type="text" name="product_name" class="form-control" placeholder="商品名">
                    @error('product_name')
                        <span class ="error">商品名を入力してください</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>メーカー名</lebel>
                    <select name="company_id" class="form-select">
                        <option>メーカーを選択してください</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id}}">{{ $company->company_name}}</option>
                        @endforeach
                    </select>
                    @error('company')
                        <span class ="error">メーカーを選択してください</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>価格</lebel>
                        <input type="text" name="price" class="form-control" placeholder="価格">
                        @error('price')
                            <span class ="error">価格を半角数字で入力してください</span>
                        @enderror
                </div>
                <div class="form-group">
                    <label>在庫数</lebel>
                    <input type="text" name="stock" class="form-control" placeholder="在庫数">
                    @error('stock')
                        <span class ="error">在庫数を半角数字で入力してください</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>コメント</lebel>
                        <textarea class="form-control" style="height:100px" name="comment" class="form-control" placeholder="コメント"></textarea>
                </div>
                <div class="form-group">
                    <label>商品画像</lebel>
                    <input type="file" name="img_path" class="form-control" placeholder="image">
                </div>
            </div>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">登録</button>
                <a class="btn btn-success" href="{{ url('/products')}}">戻る</a>
            </div>
        </form>
    </div>
@endsection
    