@extends('page')

@section('head')
    <link rel="stylesheet" href="/assets/css/admin/page.css">
    <link rel="stylesheet" href="/assets/css/admin/products.css">
@endsection

@section('scripts')
    <script src="/assets/js/multiple-live-photo.js" defer></script>
@endsection

@section('content')
    @if(isset($success))
        <div class="alert alert-success mx-auto mt-2 col-10 col-md-4" role="alert">
            Операция успешно выполнена
        </div>
    @else
        <div class="d-flex justify-content-center p-3">
            <form method="POST" enctype="multipart/form-data" class="bg-white px-3 pb-3 col-sm-10 col-md-7 col-lg-6 col-xl-4 rounded" >
                @csrf
                <span class="fw-bold fs-3 text mt-2 mb-3 d-block">Продукция</span>
                <div class="mb-3">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="inputTitle" placeholder="Заголовок" value="{{ $product->title }}">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }} </strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Описание" rows="5" name="description" id="inputDescription">{{ $product->description }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }} </strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="upload form-control @error('photo') is-invalid @enderror">
                        <span class="fs-5 text-center">Загрузите или перетащите фотографии</span>
                        <input type="file" id="inputPhoto" name="photo[]" multiple>
                    </div>
                    <small class="form-text text-muted">Максимальное количество фотографий 3</small>
                    @error('photo')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }} </strong>
                        </span>
                    @enderror
                    <div id="imgs">
                        @foreach($photos as $key => $photo_url)
                        <div>
                            <div class="img-product">
                                <img src="/assets/static/img/products/{{$photo_url}}">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Редактировать</button>
            </form>
        </div>
    @endif
    <a href="{{ route('AdminProducts') }}" class="text-secondary mx-auto my-3">Назад</a>
@endsection
