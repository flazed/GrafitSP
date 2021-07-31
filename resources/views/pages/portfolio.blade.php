@extends('page')

@section('head')
    <link rel="stylesheet" href="/assets/css/user/portfolio.css">
@endsection

@section('scripts')
    <script src="/assets/js/vue/user/portfolio.js" defer></script>
@endsection

@section('content')
    <div id="big-picture" v-bind:class="{ 'show' : show }">
        <img :src="src" v-on:click="leaveBigPicture">
        <div class="desc">
            <span class="title">@{{ title }}</span>
            <span class="description">@{{ description }}</span>
        </div>
    </div>
    <div class="portfolio">
        @foreach($portfolio as $key=>$item)
        <div class="item">
            <img    src="/assets/static/img/portfolio/{{ $item->photo_url }}" data-title="{{ $item->title }}" data-description="{{ $item->description }}" v-on:click="setBigPicture($event)">
        </div>
        @endforeach
    </div>
@endsection
