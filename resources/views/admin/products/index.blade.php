@extends('page')

@section('head')
    <link rel="stylesheet" href="/assets/css/admin/products.css">
@endsection

@section('content')
<div class="col-lg-10 col-xl-10 mx-auto mt-3">
    <a href="{{ route('AdminProductsCreate') }}" class="text-info h4">Добавить продукцию</a>
</div>
<table class="table col-lg-10 col-xl-10 mx-auto mt-3">
    <thead>
      <tr>
        <th scope="col" class="text-center">#</th>
        <th scope="col">Заголовок</th>
        <th scope="col">Описание</th>
        <th scope="col">Фото</th>
        <th scope="col" class="text-center">Действия</th>
      </tr>
    </thead>
    <tbody>
        @foreach($products as $key => $item)
        <tr>
            <th scope="row">{{ $item->id }}</th>
            <td> <a href="{{ route('AdminProductsView', $item->id) }}" class="text-primary">{{ $item->title }}</a></td>
            <td> <p class="description">{{ $item->description }}</p> </td>
            <td>
                @foreach($photos[$key] as $photo_url)
                <div class="product-photo">
                    <img src="/assets/static/img/products/{{$photo_url}}">
                </div>
                @endforeach
            </td>
            <td class="d-flex justify-content-center">
                <a href="{{ route('AdminProductsEdit', $item->id) }}" class="btn btn-warning">Редактировать</a>
                <a href="{{ route('AdminProductsDelete', $item->id) }}" class="btn btn-danger ml-2">Удалить</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="mx-auto mt-auto">{{ $products->links() }}</div>
@endsection
