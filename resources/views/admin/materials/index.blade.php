@extends('page')

@section('head')
    <link rel="stylesheet" href="/assets/css/admin/portfolio.css">
@endsection

@section('content')
<div class="col-lg-10 col-xl-10 mx-auto mt-3">
    <a href="{{ route('AdminMaterialsCreate') }}" class="text-info h4">Добавить материал</a>
</div>
<table class="table col-lg-10 col-xl-10 mx-auto mt-3">
    <thead>
      <tr>
        <th scope="col" class="text-center">#</th>
        <th scope="col">Название</th>
        <th scope="col">Категория</th>
        <th scope="col" class="text-center">до 10м²</th>
        <th scope="col" class="text-center">до 50м²</th>
        <th scope="col" class="text-center">до 200м²</th>
        <th scope="col" class="text-center">от 200м²</th>
        <th scope="col" class="text-center">Действия</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($materials as $item)
            <tr>
                <th scope="row">{{ $item->id }}</th>
                <td> <a href="{{ route('AdminMaterialsView', $item->id) }}" class="text-primary">{{ $item->name }}</a></td>
                <td>
                    @foreach ($dpi as $el)
                        {{ $el->id ===  $item->print_dpi_id ? $el->dpi : ''}}
                    @endforeach
                </td>
                <td class="text-center">{{ $item->m10 }} ₽</td>
                <td class="text-center">{{ $item->m50 }} ₽</td>
                <td class="text-center">{{ $item->m200 }} ₽</td>
                <td class="text-center">{{ $item->m200plus }} ₽</td>
                <td class="d-flex justify-content-center">
                    <a href="{{ route('AdminMaterialsEdit', $item->id) }}" class="btn btn-warning">Редактировать</a>
                    <a href="{{ route('AdminMaterialsDelete', $item->id) }}" class="btn btn-danger ml-2">Удалить</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mx-auto mt-auto">{{ $materials->links() }}</div>
@endsection
