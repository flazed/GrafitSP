@extends('page')

@section('head')
    <link rel="stylesheet" href="/assets/css/admin/page.css">
    <link rel="stylesheet" href="/assets/css/admin/products.css">
@endsection

@section('content')
<div class="card mt-5 mx-auto" style="max-width: 27rem;">
    <div class="card-body">
      <h5 class="card-title">{{$product->title}}</h5>
      <p class="card-text">{{$product->description}}</p>
        @foreach($photos as $photo_url)
        <div class="show-img">
            <img src="/assets/static/img/products/{{$photo_url}}">
        </div>
        @endforeach
    </div>
  </div>
  <a href="{{ route('AdminProducts') }}" class="text-secondary mx-auto my-3">Назад</a>
@endsection
