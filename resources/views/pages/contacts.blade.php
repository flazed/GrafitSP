@extends('page')

@section('content')
    @if($success)
        <div class="alert alert-success col-11 col-sm-9 col-md-7 col-lg-7 col-xl-4 mx-auto mt-3" role="alert">
            Вашe сообщение успешно отправлено!
        </div>
    @else
        <form action="{{ route('contacts') }}" method="POST" class="col-11 col-sm-9 col-md-7 col-lg-7 col-xl-4 mx-auto my-3 p-3 bg-white rounded">
            @csrf
            <div class="form-group">
                <label for="name">Имя: </label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Ваше Имя" value="{{ old('name') }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Ваш email" value="{{ old('email') }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="message">Имя: </label>
                <textarea class="form-control @error('message') is-invalid @enderror" id="message" rows="4" name="message" placeholder="Ваше сообщение" value="{{ old('message') }}"></textarea>
                @error('message')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    @endif
@endsection