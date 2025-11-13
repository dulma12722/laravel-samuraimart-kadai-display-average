{{-- 2025-10-23 Bootstrap導入のためコメントアウト --}}
{{-- <div>
   <h2>Add New Product</h2>
</div>
<div>
   <a href="{{ route('products.index') }}"> Back</a>
</div>

<form action="{{ route('products.store') }}" method="POST">
   @csrf

   <div>
       <strong>Name:</strong>
       <input type="text" name="name" placeholder="Name">
   </div>
   <div>
       <strong>Description:</strong>
       <textarea style="height:150px" name="description" placeholder="Description"></textarea>
   </div>
   <div>
       <strong>Price:</strong>
       <input type="number" name="price" placeholder="Price">
   </div> --}}
   {{-- 2025-10-23 カテゴリを選択・保存 --}}
   {{-- <div>
        <strong>Category:</strong>
        <select name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
   </div>
   <div>
       <button type="submit">Submit</button>
   </div>

</form> --}}

@extends('layouts.app')

@section('content')
<div class="container">
   <h1>新しい商品を追加</h1>

   <form action="{{ route('products.store') }}" method="POST">
       @csrf
       <div class="form-group">
           <label for="product-name">商品名</label>
           <input type="text" name="name" id="product-name" class="form-control">
       </div>
       <div class="form-group">
           <label for="product-description">商品説明</label>
           <textarea name="description" id="product-description" class="form-control"></textarea>
       </div>
       <div class="form-group">
           <label for="product-price">価格</label>
           <input type="number" name="price" id="product-price" class="form-control">
       </div>
       <div class="form-group">
           <label for="product-category">カテゴリ</label>
           <select name="category_id" class="form-control" id="product-category">
               @foreach ($categories as $category)
                   <option value="{{ $category->id }}">{{ $category->name }}</option>
               @endforeach
           </select>
       </div>
       <button type="submit" class="btn btn-success">商品を登録</button>
   </form>

   <a href="{{ route('products.index') }}">商品一覧に戻る</a>
</div>
@endsection