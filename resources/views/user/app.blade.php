@extends('user.template.template')

@section('content')
    {{-- Halaman home --}}
    <div class="page" id="home">
        @include('user.partials.carousel')
        @include('user.partials.exelence')
        @include('user.partials.favoriteMenu')
    </div>

    {{-- Halaman menu --}}
    <div class="page" id="menu">
        @include('user.partials.menu')
    </div>


    {{-- Halaman about --}}
    <div class="page" id="about">
        @include('user.partials.aboutUs')
    </div>
@endsection
