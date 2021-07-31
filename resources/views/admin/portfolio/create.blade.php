@extends('page')

@section('head')
    <link rel="stylesheet" href="/assets/css/admin/page.css">
    <link rel="stylesheet" href="/assets/css/admin/portfolio.css">
@endsection

@section('scripts')
    <script src="/assets/js/vue/admin/portfolio.js" defer></script>
    <script src="/assets/js/live-photo.js" defer></script>
@endsection

@section('content')
    <div class="alert-block w-100" v-bind:class="{'active' : alert}">
        <div class="alert alert-success mx-auto mt-2 col-10 col-md-4" role="alert">
            Операция успешно выполнена
        </div>
    </div>
    <div class="d-flex justify-content-center p-3">
        <form method="POST" enctype="multipart/form-data" class="bg-white px-3 pb-3 col-sm-10 col-md-7 col-lg-6 col-xl-4 rounded" >
            @csrf
            <span class="fw-bold fs-3 text mt-2 mb-3 d-block">Портфолио</span>
            <div class="mb-3">
                <input type="text" class="form-control" v-bind:class="{ 'is-invalid': errors.title }" v-model="valid.title" v-on:keydown="removeError($event)" name="title" id="inputTitle" placeholder="Заголовок">
                <span v-if="errors.title" class="invalid-feedback" role="alert">
                    <strong>@{{ errors.title }}</strong>
                </span>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" v-bind:class="{ 'is-invalid': errors.description }" v-model="valid.description" v-on:keydown="removeError($event)" name="description" id="inputDescription" placeholder="Описание">
                <span v-if="errors.description" class="invalid-feedback" role="alert">
                    <strong>@{{ errors.description }}</strong>
                </span>
            </div>
            <div class="mb-3">
                <div class="upload form-control" v-bind:class="{ 'is-invalid': errors.photo }">
                    <span class="fs-5 text-center">Загрузите или перетащите фотографию</span>
                    <input type="file" id="inputPhoto" name="photo" v-on:change="addPhoto($event)">
                    <img src="">
                </div>
                <span v-if="errors.photo" class="invalid-feedback" role="alert">
                    <strong>@{{ errors.photo }}</strong>
                </span>
            </div>
            <button type="submit" class="btn btn-primary" v-on:click="addPortfolio($event)">Добавить</button>
        </form>
    </div>
    <a href="{{ route('AdminPortfolio') }}" class="text-secondary mx-auto my-3">Назад</a>
@endsection
