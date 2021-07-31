<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/assets/static/icons/icon.png" type="image/x-icon">
    {{-- Styles --}}
    <link rel="stylesheet" href="/assets/css/user/page.css">
    <link rel="stylesheet" href="/assets/css/user/appearance.css">
    @yield('head')
    {{-- BootStrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <script src="/assets/js/activeUrl.js" defer></script>
    <script src="/assets/js/appearance.js" defer></script>
    <script src="/assets/js/mobile-menu.js" defer></script>
    <script src="/assets/js/000.js" defer></script>
    @yield('scripts')
    <title>Графит - рекламно-производственное агенство</title>
</head>
<body>
    <div class="content">
        <header>
            <svg>
                <a href="{{ route('main') }}"><use xlink:href="/assets/static/icons/logo.svg#grafit" fill="#252525"/></a>
            </svg>
            <div class="mobile-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <nav class="d-flex px-5">
                <li class="nav-item"><a class="nav-link menu" href="{{ route('main') }}">Главная</a></li>

                <li class="nav-item dropdown">
                    <a class="nav-link menu dropdown-toggle text-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ассортимент
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item nav-link" href="{{ route('products') }}">Продукция</a>
                        <a class="dropdown-item nav-link" href="{{ route('prices') }}">Прайс-лист</a>
                        <a class="dropdown-item nav-link" href="{{ route('portfolio') }}">Портфолио</a>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link menu" href="{{ route('basket') }}">Корзина</a></li>
                <li class="nav-item"><a class="nav-link menu" href="{{ route('contacts') }}">Контакты</a></li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link text-info menu" href="{{ route('login') }}">{{ __('Войти') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link text-info menu" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-info" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->role)
                                    <a class="dropdown-item" href="{{ route('AdminPortfolio') }}">Портфолио</a>
                                    <a class="dropdown-item" href="{{ route('AdminProducts') }}">Продукция</a>
                                    <a class="dropdown-item" href="{{ route('AdminMaterials') }}">Материалы</a>
                                    <a class="dropdown-item" href="{{ route('AdminOrders') }}">Заказы</a>
                                    <div class="dropdown-divider"></div>
                                @endif
                                <a class="dropdown-item" href="{{ route('UserOrders') }}">Мои заказы</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Выйти') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
            </nav>

            <div class="contact-us">
                <a href="tel: +84965510721">8(496)551-07-21</a> /
                <a href="mailto: grafitsp@yandex.ru">grafitsp@yandex.ru</a>
            </div>
        </header>
        <div class="main">
            @yield('content')
        </div>
        <footer>
            <div class="contacts d-flex px-5">
                <svg>
                    <use xlink:href="/assets/static/icons/logo.svg#grafit" fill="#252525"/>
                </svg>

                <div class="contacts__copyright">
                    ООО «Графит» 2018-<?= date('Y')?> г.
                </div>

                <div class="contacts__links">
                    <a href="https://vk.com/ragrafitsp"><i class="fa fa-vk" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
