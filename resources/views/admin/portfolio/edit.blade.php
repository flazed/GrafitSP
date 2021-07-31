@extends('page')

@section('head')
    <link rel="stylesheet" href="/assets/css/admin/page.css">
    <link rel="stylesheet" href="/assets/css/admin/portfolio.css">
@endsection

@section('scripts')
    <script src="/assets/js/live-photo.js" defer></script>
@endsection

@section('content')
    @if(isset($success))
        <div class="alert alert-success mx-auto mt-4 col-10 col-md-4" role="alert">
            Операция успешно выполнена
        </div>
    @else
        <div class="d-flex justify-content-center p-3">
            <form method="POST" enctype="multipart/form-data" class="bg-white px-3 pb-3 col-sm-10 col-md-7 col-lg-6 col-xl-4 rounded" >
                @csrf
                <span class="fw-bold fs-3 text mt-2 mb-3 d-block">Портфолио</span>
                <div class="mb-3">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="inputTitle" placeholder="Заголовок" value="{{ $portfolio->title }}">
                    @error('title')
                        <strong class="invalid-feedback" role="alert">
                            {{ $message }}
                        </strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="inputDescription" placeholder="Описание" value="{{ $portfolio->description }}">
                    @error('description')
                        <strong class="invalid-feedback" role="alert">
                            {{ $message }}
                        </strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="upload form-control @error('photo') is-invalid @enderror">
                        <span class="fs-5 text-center">Загрузите или перетащите фотографию</span>
                        <input type="file" id="inputPhoto" name="photo">
                        <img class="active" src="/assets/static/img/portfolio/{{ $portfolio->photo_url }}">
                    </div>
                    @error('photo')
                        <strong class="invalid-feedback" role="alert">
                            {{ $message }}
                        </strong>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Редактировать</button>
            </form>
        </div>
    @endif
        <a href="{{ route('AdminPortfolio') }}" class="text-secondary mx-auto my-3">Назад</a>
@endsection
