@extends('page')

@section('head')
    <link rel="stylesheet" href="/assets/css/admin/page.css">
    <link rel="stylesheet" href="/assets/css/admin/portfolio.css">
@endsection

@section('content')
    <form method="POST" class="text-center col-10 col-sm-7 col-md-5 col-lg-4 mx-auto p-3 mt-3 border rounded border-secondary d-flex flex-column">
        @csrf
        <span>Вы точно хотите удалить портфолио <strong>"{{ $portfolio->title }}"</strong> под номером <strong>#{{ $portfolio->id }}</strong> ?</span>
        <div class="d-flex justify-content-center mt-3">
            <button type="submit" class="btn btn-danger mr-3">Удалить</button>
            <a href="{{ route('AdminPortfolio') }}" class="btn btn-secondary">Назад</a>
        </div>
    </form>
@endsection
