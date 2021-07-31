@extends('page')

@section('head')
    <link rel="stylesheet" href="/assets/css/user/main.css">
@endsection

@section('scripts')
    <script src="/assets/js/slider.js" defer></script>
    <script src="/assets/js/toggle-adress.js" defer></script>
@endsection

@section('content')
    <div class="slider">
        <div class="slider__slides">
            <div class="slide active">
                <img src="/assets/static/img/slider/slide1.png">
                <div class="description">
                    <span>Мы не просто работаем!</span>
                    <span>Мы создаем!</span>
                </div>
            </div>
            <div class="slide">
                <img src="/assets/static/img/slider/slide2.png">
                <div class="description">
                    <span>В сфере дизайна - для нас нет ничего невозможного!</span>
                </div>
            </div>
            <div class="slide">
                <img src="/assets/static/img/slider/slide3.png">
                <div class="description">
                    <span>Любые размеры! От маленькой визитки до огромных баннеров!</span>
                </div>
            </div>
        </div>
    </div>
    <div id="about-us" class="d-flex">
        <h1>О нас</h1>
        <div class="w-75 d-flex">
            <div class="employers qualitys d-flex">
                <div class="content-row">
                    <div class="quality appearance appearance-left">
                        <h3>10 лет качества</h3>
                        <p>Наша компания успешно работает на рынке печати наружной рекламы более 10 лет и предоставляет полный спектр услуг — начиная с разработки дизайна, заканчивая постпечатной обработкой, вплоть до сборки рекламных конструкций.</p>
                    </div>
                    <div class="employer appearance appearance-right">
                        <img src="/assets/static/img/employers/Olga.png">
                        <span class="name mt-3">Ольга Александровна</span>
                        <span class="post">Генеральный директор</span>
                    </div>
                </div>
                <div class="content-row">
                    <div class="quality appearance appearance-left">
                        <h3>Лучшее оборудование</h3>
                        <p>Наше предприятие оснащено многофункциональным, современным оборудованием, что позволяет нам выпускать и издавать все — от листовки до вывесок любой сложности в максимально короткий срок.</p>
                        <p>Наша основная цель — высокое качество производимой продукции по доступной цене!</p>
                    </div>
                    <div class="employer appearance appearance-right">
                        <img src="/assets/static/img/employers/Yulia.png">
                        <span class="name mt-3">Юлия</span>
                        <span class="post">Менеджер-дизайнер</span>
                    </div>
                </div>
                <div class="content-row">
                    <div class="quality appearance appearance-left">
                        <h3>Работаем для вас</h3>
                        <p>Если вы еще не определились и не знаете что вам нужно — перейдите в соответствующий раздел. Там вы  ознакомитесь с основной рекламной продукцией, которую мы сможем для вас изготовить. В разделе прайс-лист — актуальные цены, а в разделе портфолио — примеры наших работ! Оставайтесь с нами!</p>
                    </div>
                    <div class="employer appearance appearance-right">
                        <img src="/assets/static/img/employers/Nastya.png">
                        <span class="name mt-3">Анастасия</span>
                        <span class="post">Менеджер-дизайнер</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="clients" class="d-flex">
        <h1>Нас выбирают</h1>
        <div class="clients-block mt-4 appearance appearance-down">
            @foreach($clients as $key => $client)
                <div class="client">
                    <img src="/assets/static/img/clients/{{ basename($client) }}">
                </div>
            @endforeach
        </div>
    </div>
    <div id="place">
        <div class="adress d-flex flex-column active">
            <h2>Контакты</h2>
            <div class="adress-block d-flex flex-column">
                <span class="city">Сергиев-Посад</span>
                <span>пр. Красной Армии, д.52</span>
                <a href="tel: +84965510721">8(496)551-07-21</a>
                <a href="mailto: grafitsp@yandex.ru">grafitsp@yandex.ru</a>
                <span>пн - пт 10:00 – 18:00</span>
            </div>
            <div class="adress-toggle"><span></span></div>
        </div>
        <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A0062cacb2cc09ca78f1f3e1498ef1bf195d5b4c9002b03e874c42511d11749b1&amp;source=constructor" width="100%" height="450" frameborder="0"></iframe>
    </div>
@endsection
