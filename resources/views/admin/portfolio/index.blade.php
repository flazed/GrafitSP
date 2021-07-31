@extends('page')

@section('head')
    <link rel="stylesheet" href="/assets/css/admin/portfolio.css">
@endsection

@section('content')
<div class="col-lg-10 col-xl-10 mx-auto mt-3">
    <a href="{{ route('AdminPortfolioCreate') }}" class="text-info h4">Добавить портфолио</a>
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
        @foreach ($portfolio as $item)
            <tr>
                <th scope="row">{{ $item->id }}</th>
                <td> <a href="{{ route('AdminPortfolioView', $item->id) }}" class="text-primary">{{ $item->title }}</a></td>
                <td>{{ $item->description }}</td>
                <td> <img src="/assets/static/img/portfolio/{{ $item->photo_url }}" class="table_img rounded"></td>
                <td class="d-flex justify-content-center">
                    <a href="{{ route('AdminPortfolioEdit', $item->id) }}" class="btn btn-warning">Редактировать</a>
                    <a href="{{ route('AdminPortfolioDelete', $item->id) }}" class="btn btn-danger ml-2">Удалить</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mx-auto mt-auto">{{ $portfolio->links() }}</div>
@endsection
