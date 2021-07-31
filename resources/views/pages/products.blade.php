@extends('page')

@section('head')
    <link rel="stylesheet" href="/assets/css/user/products.css">
@endsection

@section('content')
    <div class="d-flex flex-column align-items-center p-3" id="products">
        <div class="line">
            <div class="clm">
                <div class="description appearance appearance-left p-0">
                    <h1>Продукция</h1>
                    <p>Одно из преимуществ нашей компании – собственное производство в Сергиевом Посаде. Заказав вывеску, штендер или визитки у нас вам не надо будет никуда ехать. Всё рядом!</p>
                    <p>Дизайн, широкоформатная печать, полиграфия, наружная реклама – это все мы делаем сами, для наших клиентов!</p>
                    <p>На этой страничке вы сможете ознакомится с основной рекламной продукцией которую мы сможем для вас изготовить! Если вас интересует что-то более конкретное - посмотрите подробный прайс-лист. Есть вопрос? Напишите нам или спросите он-лайн.</p>
                </div>
            </div>
            <div class="clm"></div>
        </div>
        @foreach($products as $key => $item)
            <div class="line">
                @if($key%2 == 0)
                    <div class="clm d-flex flex-column">
                        @foreach($photos[$key] as $photo_url)
                            <div class="product-photo appearance appearance-left">
                                <img src="/assets/static/img/products/{{$photo_url}}">
                            </div>
                        @endforeach
                    </div>
                    <div class="clm appearance appearance-right">
                        <div class="sticky product-info p-3">
                            <h3>{{ $item->title }}</h3>
                            <p>{{ $item->description }}</p>
                        </div>
                    </div>
                @else
                    <div class="clm appearance appearance-left">
                        <div class="sticky product-info p-3">
                            <h3>{{ $item->title }}</h3>
                            <p>{{ $item->description }}</p>
                        </div>
                    </div>
                    <div class="clm d-flex flex-column">
                        @foreach($photos[$key] as $photo_url)
                            <div class="product-photo appearance appearance-right">
                                <img src="/assets/static/img/products/{{$photo_url}}">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
@endsection
