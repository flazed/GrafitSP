@extends('page')

@section('head')
    <link rel="stylesheet" href="/assets/css/admin/page.css">
@endsection

@section('content')
<div class="card mt-5 mx-auto" style="max-width: 35rem;">
    <div class="card-body">
      <h5 class="card-title">{{ $material->name }}</h5>
      <p class="card-text">Категория: {{ $category->dpi }}</p>
      <p class="card-text">Цена за материал до 10м²: {{ $material->m10 }}₽</p>
      <p class="card-text">Цена за материал от 10 до 50м²: {{ $material->m50 }}₽</p>
      <p class="card-text">Цена за материал от 50 до 200м²: {{ $material->m200 }}₽</p>
      <p class="card-text">Цена за материал от 200м²: {{ $material->m200plus }}₽</p>
    </div>
  </div>
  <a href="{{ route('AdminMaterials') }}" class="text-secondary mx-auto my-3">Назад</a>
@endsection
