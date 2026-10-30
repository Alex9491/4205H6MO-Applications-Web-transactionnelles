@extends('layouts.app')

@section('title', __('interface.create_title'))

@section('content')
    <h1>{{ __('interface.create_title') }}</h1>

    <form
        method="post"
        action="{{ route('recettes.store') }}"
        enctype="multipart/form-data"
    >
        @include('recettes._form', ['recette' => null])
    </form>

    <p>
        <a href="{{ route('recettes.index') }}">
            {{ __('interface.back_recipes') }}
        </a>
    </p>
@endsection
