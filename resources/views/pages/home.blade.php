@extends('layouts.app')

@section('title', 'Home')
@section('page_title', 'Selamat datang di Waroeng Chindo')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Selamat Mamam!!</h1>
    <p class="mb-4">Berikut adalah menu waroeng china original</p>

    <div class="flex flex-wrap gap-4">
        @include('components.card', [
            'imgsrc' => 'images/pudding durian.jpeg',
            'title' => 'Pudding Durian Special By Zhang Hao',
            'desc' => 'Makanan enak, dan sodap.'
        ])

        @include('components.card', [
            'imgsrc' => 'images/katak.jpg',
            'title' => 'Sup Kaki Katak',
            'desc' => 'Katak impor China, sekali cuba langsung jadi China.'
        ])

        @include('components.card', [
            'imgsrc' => 'images/jangkrik.jpeg',
            'title' => 'Jangkrik Goreng Exclusive',
            'desc' => 'Certified got cooked. Bro went from chirpin’ to chillin’ in oil.'
        ])
    </div>
@endsection
