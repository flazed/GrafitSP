@extends('page')

@section('head')
    <link rel="stylesheet" href="/assets/css/admin/page.css">
    <link rel="stylesheet" href="/assets/css/admin/portfolio.css">
@endsection

@section('content')
    <form method="POST" class="text-center col-10 col-sm-7 col-md-5 col-lg-4 mx-auto p-3 mt-3 border rounded border-secondary d-flex flex-column">
        @csrf
        <span>Вы точно хотите удалить заказ под номером <strong>#{{ $order->id }}</strong> ?</span>
        <div class="form-control h-100 text-left mt-2">
            <span class="d-block mb-3">Email: {{$order->mail}}</span>
            @foreach ($materials as $k => $v)
            <span class="d-flex"><h6>{{$v->name}}</h6> <span class="ml-auto">{{$order->order[$k]->count}} м² ({{$order->order[$k]->price}} ₽)</span></span>
            @endforeach
            <span class="d-block mt-3">Итого: {{$order->total}} ₽</span>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <button type="submit" class="btn btn-danger mr-3">Удалить</button>
            <a href="{{ route('AdminOrders') }}" class="btn btn-secondary">Назад</a>
        </div>
    </form>
@endsection
