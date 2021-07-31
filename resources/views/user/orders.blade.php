@extends('page')

@section('content')
@if($orders)
<table class="table table-striped border-bottom col-lg-8 col-xl-7 mx-auto mt-3">
    <thead>
      <tr>
        <th scope="col">Номер заказа</th>
        <th scope="col">Товары</th>
        <th scope="col">Цена</th>
        <th scope="col" class="text-center">Статус</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($orders as $key => $value)
            <tr>
                <th scope="row">{{ $value->id }}</th>
                <td>
                    @foreach ($materials[$key] as $k => $v)
                    <span class="d-flex"><h6>{{$v->name}}</h6> <span class="ml-auto mr-5">{{$value->order[$k]->count}} м²</span></span>
                    @endforeach
                </td>
                <td>{{ $value->total }} ₽</td>
                <td>
                @if($value->status == 0)
                    <div class="p-1 rounded bg-warning text-center w-100 text-white">
                        В процессе
                    </div>
                @elseif($value->status == 1)
                    <div class="p-1 rounded bg-success text-center w-100 text-white">
                        Завершен
                    </div>
                @elseif($value->status == 2)
                    <div class="p-1 rounded bg-danger text-center w-100 text-white">
                        Отклонено
                    </div>
                @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mx-auto mt-auto">{{ $orders->links() }}</div>
@else
<div class="mx-auto text-center my-3">
    Заказы не найдены! <br> Наберите товаров в разделе <a href="{{route('prices')}}">Прайс-лист</a> и оформите заказ в <a href="{{route('basket')}}">Корзине</a>!
</div>
@endif
@endsection
