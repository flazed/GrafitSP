@extends('page')

@section('head')
    <link rel="stylesheet" href="/assets/css/admin/page.css">
@endsection

@section('content')
    @if(isset($success))
        <div class="alert alert-success mx-auto mt-4 col-10 col-md-4" role="alert">
            Операция успешно выполнена
        </div>
    @else
        <div class="d-flex justify-content-center p-3">
            <form method="POST" class="bg-white px-3 pb-3 col-sm-10 col-md-7 col-lg-6 col-xl-4 rounded" >
                @csrf
                <span class="fw-bold fs-3 text mt-2 mb-3 d-block">Материал</span>
                <div class="mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputTitle" placeholder="Название" value="{{ old('name') }}">
                    @error('name')
                        <strong class="invalid-feedback" role="alert">
                            {{ $message }}
                        </strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <select class="custom-select @error('print_dpi_id') is-invalid @enderror" name="print_dpi_id">
                        <option selected hidden disabled>Выберите категорию</option>
                        @foreach ($dpi as $item)
                            <option value="{{ $item->id }}">{{ $item->dpi }}</option>
                        @endforeach
                    </select>
                    @error('print_dpi_id')
                        <strong class="invalid-feedback" role="alert">
                            {{ $message }}
                        </strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control @error('m10') is-invalid @enderror" name="m10" placeholder="Цена за материал до 10м²" value="{{ old('m10') }}">
                    @error('m10')
                        <strong class="invalid-feedback" role="alert">
                            {{ $message }}
                        </strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control @error('m50') is-invalid @enderror" name="m50" placeholder="Цена за материал от 10 до 50м²" value="{{ old('m50') }}">
                    @error('m50')
                        <strong class="invalid-feedback" role="alert">
                            {{ $message }}
                        </strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control @error('m200') is-invalid @enderror" name="m200" placeholder="Цена за материал от 50 до 200м²" value="{{ old('m200') }}">
                    @error('m200')
                        <strong class="invalid-feedback" role="alert">
                            {{ $message }}
                        </strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control @error('m200plus') is-invalid @enderror" name="m200plus" placeholder="Цена за материал от 200м²" value="{{ old('m200plus') }}">
                    @error('m200plus')
                        <strong class="invalid-feedback" role="alert">
                            {{ $message }}
                        </strong>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>
    @endif
        <a href="{{ route('AdminMaterials') }}" class="text-secondary mx-auto my-3">Назад</a>
@endsection
