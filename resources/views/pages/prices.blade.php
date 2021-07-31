@extends('page')

@section('head')
    <link rel="stylesheet" href="/assets/css/user/prices.css">
@endsection

@section('scripts')
    <script src="/assets/js/vue/user/basket.js" defer></script>
    <script src="http://unpkg.com/cookielib/src/cookie.js"></script>
@endsection

@section('content')
    <div class="container">
        @foreach($print_dpi as $dpi)
        <table class="table table-striped mb-5">
            <span class="d-block fs-4 mt-4 fw-light">{{ $dpi->dpi }}</span>
            <thead>
                <tr>
                    <th scope="col">Материал</th>
                    <th class="text-center">от 1 до 10 м²</th>
                    <th class="text-center">от 10 до 50 м²</th>
                    <th class="text-center">от 50 до 200 м²</th>
                    <th class="text-center">от 200 м²</th>
                </tr>
            </thead>
            <tbody>
            @foreach($materials as $material)
                @if($dpi->id == $material->print_dpi_id)
                <tr>
                    <th scope="row"> {{ $material->name }} </th>
                    <td class="text-center"> {{ $material->m10 }} ₽</td>
                    <td class="text-center"> {{ $material->m50 }} ₽</td>
                    <td class="text-center"> {{ $material->m200 }} ₽</td>
                    <td class="text-center"> {{ $material->m200plus }} ₽</td>
                    <td class="text-center basket">
                        <div class="btn-basket" v-if="cookieBasket['{{$material->id}}'] == undefined" v-on:click="addToBasketClick($event, {{$material->id}}, '{{$material->name}}', [
                            {{$material->m10}},
                            {{$material->m50}},
                            {{$material->m200}},
                            {{$material->m200plus}}])">В корзину
                        </div>
                        <div class="btn-basket active" v-else v-on:click="addToBasketClick($event, {{$material->id}}, '{{$material->name}}', [
                            {{$material->m10}},
                            {{$material->m50}},
                            {{$material->m200}},
                            {{$material->m200plus}}])">Убрать
                        </div>
                    </td>
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
        @endforeach
    </div>
@endsection
