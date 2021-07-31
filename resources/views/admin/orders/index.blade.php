@extends('page')

@section('head')
    <link rel="stylesheet" href="/assets/css/admin/portfolio.css">
@endsection

@section('content')
<table class="table col-lg-10 col-xl-10 mx-auto mt-3">
    <thead>
      <tr>
        <th scope="col">Номер заказа</th>
        <th scope="col">Email</th>
        <th scope="col">Товары</th>
        <th scope="col">Цена</th>
        <th scope="col" class="text-center">Статус</th>
        <th scope="col" class="text-center">Действия</th>
      </tr>
    </thead>
    <tbody>
        @foreach($orders as $key => $value)
            <tr>
                <th scope="row">{{ $value->id }}</th>
                <td>{{ $value->mail }}</td>
                <td>
                    @foreach ($materials[$key] as $k => $v)
                    <span class="d-flex"><h6>{{$v->name}}</h6> <span class="ml-auto mr-5">{{$value->order[$k]->count}} м²</span></span>
                    @endforeach
                </td>
                <td>{{ $value->total }} ₽</td>
                <td>
                @if($value->status == 0)
                    <div class="p-1 rounded text-warning text-center w-100 text-white">
                        В процессе
                    </div>
                @elseif($value->status == 1)
                    <div class="p-1 rounded text-success text-center w-100 text-white">
                        Завершен
                    </div>
                @elseif($value->status == 2)
                    <div class="p-1 rounded text-danger text-center w-100 text-white">
                        Отклонено
                    </div>
                @endif
                </td>
                <td class="d-flex justify-content-end">
                    @if($value->status == 0)
                    <a href="{{ route('AdminOrdersEdit', $value->id) }}" class="btn btn-warning w-100">Изменить статус</a>
                    @endif
                    <a href="{{ route('AdminOrdersDelete', $value->id) }}" class="btn btn-danger ml-3">Удалить</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mx-auto mt-auto">{{ $orders->links() }}</div>
@endsection
