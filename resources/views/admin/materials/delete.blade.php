@extends('page')

@section('head')
    <link rel="stylesheet" href="/assets/css/admin/page.css">
@endsection

@section('content')
    <form method="POST" class="text-center col-10 col-sm-7 col-md-5 col-lg-4 mx-auto p-3 mt-3 border rounded border-secondary d-flex flex-column">
        @csrf
        <span>Вы точно хотите удалить материал <strong>"{{ $material->name }}"</strong> под номером <strong>#{{ $material->id }}</strong> ?</span>
        <div class="d-flex justify-content-center mt-3">
            <button type="submit" class="btn btn-danger mr-3">Удалить</button>
            <a href="{{ route('AdminMaterials') }}" class="btn btn-secondary">Назад</a>
        </div>
    </form>
@endsection
