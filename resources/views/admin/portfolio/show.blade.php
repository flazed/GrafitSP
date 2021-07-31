@extends('page')

@section('head')
    <link rel="stylesheet" href="/assets/css/admin/page.css">
    <link rel="stylesheet" href="/assets/css/admin/portfolio.css">
@endsection

@section('content')
<div class="card mt-5 mx-auto" style="max-width: 27rem;">
    <img src="/assets/static/img/portfolio/{{ $portfolio->photo_url }}" class="card-img-top">
    <div class="card-body">
      <h5 class="card-title">{{$portfolio->title}}</h5>
      <p class="card-text">{{$portfolio->description}}</p>
    </div>
  </div>
  <a href="{{ route('AdminPortfolio') }}" class="text-secondary mx-auto my-3">Назад</a>
@endsection
