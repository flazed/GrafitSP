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
                <span class="fw-bold fs-3 text mt-2 mb-3 d-block">Заказ <b>#{{ $order->id }}</b></span>
                <div class="mb-3">
                    <span class="d-block mb-1">Email:</span>
                    <span class="form-control">{{ $order->mail }}</span>
                </div>
                <div class="mb-3">
                    <span class="d-block mb-1">Товары:</span>
                    <div class="form-control h-100">
                        @foreach ($materials as $k => $v)
                        <span class="d-flex"><h6>{{$v->name}}</h6> <span class="ml-auto">{{$order->order[$k]->count}} м² ({{$order->order[$k]->price}} ₽)</span></span>
                        @endforeach
                    </div>
                </div>
                <div class="mb-3">
                    <span class="d-block mb-1">Цена:</span>
                    <span class="form-control">{{ $order->total }} ₽</span>
                </div>
                <div class="mb-3">
                    <span class="d-block mb-1">Статус:</span>
                    <select class="custom-select" aria-label="Default select example" name="status">
                        <option value="0" @if($order->status == 0) selected @endif>В процессе</option>
                        <option value="1" @if($order->status == 1) selected @endif>Завершен</option>
                        <option value="2" @if($order->status == 2) selected @endif>Отклонен</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Редактировать</button>
            </form>
        </div>
    @endif
        <a href="{{ route('AdminOrders') }}" class="text-secondary mx-auto my-3">Назад</a>
@endsection
