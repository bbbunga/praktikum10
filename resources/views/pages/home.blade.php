@extends('layouts.app')

@section('title', 'Home')
@section('page_title', 'Selamat datang di Warung Hao')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Selamat Mamam!!</h1>
    <p class="mb-4">Berikut adalah menu mamam malam</p>

    @include('components.card', [
        'imgsrc' => 'images/jian bing.jpg',
        'title' => 'Jian Bing Made By Hao',
        'desc' => 'Kuliner unik khas china, sekali cuba langsung jadi china.'
    ])
@endsection
