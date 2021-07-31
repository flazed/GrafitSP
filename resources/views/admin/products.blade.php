@extends('page')

@section('head')
    <link rel="stylesheet" href="/assets/css/admin/page.css">
    <link rel="stylesheet" href="/assets/css/admin/products.css">
@endsection

@section('scripts') 
    <script src="/assets/js/vue/admin/products.js" defer></script>
    {{-- <script src="/assets/js/live-photo.js" defer></script> --}}
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
            <span class="fw-bold fs-3 text mt-2 mb-3 d-block">Продукция</span>
            <div class="mb-3">
                <input type="text" class="form-control" v-bind:class="{ 'is-invalid': errors.title }" v-model="valid.title" v-on:keydown="removeError($event)" name="title" id="inputTitle" placeholder="Заголовок">
                <span v-if="errors.title" class="invalid-feedback" role="alert">
                    <strong>@{{ errors.title }}</strong>
                </span>
            </div>
            <div class="mb-3">
                <textarea class="form-control" placeholder="Описание" rows="5" v-bind:class="{ 'is-invalid': errors.description }" v-model="valid.description" v-on:keydown="removeError($event)" name="description" id="inputDescription"></textarea>
                <span v-if="errors.description" class="invalid-feedback" role="alert">
                    <strong>@{{ errors.description }}</strong>
                </span>
            </div>
            <div class="mb-3">
                <div class="upload form-control" v-bind:class="{ 'is-invalid': errors.photo.length }">
                    <span class="fs-5 text-center">Загрузите или перетащите фотографии</span>
                    <input type="file" id="inputPhoto" name="photo" multiple v-on:change="addPhoto($event)" ref="photos">
                </div>                
                <small class="form-text text-muted">Максимальное количество фотографий 3</small>
                <span v-if="errors.photo.length == 1" class="invalid-feedback" role="alert">
                    <strong>@{{ errors.photo[0] }}</strong>
                </span>
                <div id="imgs">
                    <div v-for="(img, index) in valid.photo">
                        <div class="img-product" v-bind:class="{ 'is-invalid': errors.photo[index] }">
                            <img :src="URL.createObjectURL(img)">
                            <button v-on:click="removePhoto($event, index)"></button>
                        </div>
                        <span v-if="errors.photo.length != 1" class="invalid-feedback" role="alert">
                            <strong>@{{ errors.photo[index] }}</strong>
                        </span>
                    </div>                    
                </div>
            </div>
            <button type="submit" class="btn btn-primary" v-on:click="addPortfolio($event)">Добавить</button>
        </form>
    </div>
@endsection