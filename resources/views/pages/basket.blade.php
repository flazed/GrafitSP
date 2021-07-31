@extends('page')

@section('head')
    <link rel="stylesheet" href="/assets/css/user/prices.css">
@endsection

@section('scripts')
    <script src="/assets/js/vue/user/basket.js" defer></script>
@endsection

@section('content')
    <div v-if="id" class="alert alert-success text-center col-10 col-sm-10 col-md-7 col-lg-5 col-xl-5 mx-auto mt-3">
        Ваш заказ оформлен и продублирован на Вашу почту! Его уникальный номер <b>@{{id}}</b>. В скором времени с Вами свяжутся!
    </div>
    <div v-else-if="Object.keys(basket).length != 0" class="basket-block d-flex flex-column mx-auto my-3 col-12 col-sm-12 col-md-9 col-lg-7 col-xl-6">
        <div v-for="value in basket" class="item">
            <h6>@{{value.name}}</h6>
            <div class="d-flex align-items-center">
                <span class="cost mr-3">@{{value.price}} ₽</span>
                <label :for="value.id" class="d-flex align-items-center m-0">
                    м²:
                    <input :id="value.id" type="number" class="ml-1 text-center" :value="value.count" v-on:change="changeItem($event, value.id)">
                </label>
                <button class="btn btn-danger ml-3" v-on:click="deleteItem($event, value.id)"></button>
            </div>
        </div>
        <div class="hr my-3 rounded"></div>
        <div class="d-flex justify-content-between">
            <h3>Итого: @{{total}} ₽</h3>
            <button class="btn btn-success" v-on:click="makeOrder">Оформить заказ</button>
        </div>
        @if(Auth::check())
        <input type="hidden" value="{{Auth::user()->email}}" id="email" ref="email">
        @else
        <div class="mt-2">
            <input type="email" id="email" placeholder="Ваша почта" v-model="email" v-on:change="checkValid($event)" ref="email">
        </div>
        @endif
    </div>
    <div v-else class="mt-3 mx-auto text-center">
        <h3>Корзина пустая.</h3>
        <h5>Чтобы совершить заказ, зайдите на страницу <a href="{{route('prices')}}">Прайс-лист</a>!</h5>
    </div>
@endsection
