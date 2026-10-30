@extends('layouts.app')

@section('title', __('interface.edit_title'))

@section('content')
    <h1>{{ __('interface.edit_title') }}</h1>

    <form
        method="post"
        action="{{ route('recettes.update', $recette) }}"
        enctype="multipart/form-data"
    >
        @method('PATCH')
        @include('recettes._form')
    </form>

    @if ($recette->image_path)
        <img
            src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($recette->image_path) }}"
            alt="Image de {{ $recette->nom }}"
        >

        <form
            method="post"
            action="{{ route('recettes.image.destroy', $recette) }}"
        >
            @csrf
            @method('DELETE')

            <button
                type="submit"
                onclick="return confirm('{{ __('interface.confirm_delete_image') }}')"
            >
                {{ __('interface.delete_image') }}
            </button>
        </form>
    @endif

    <p>
        <a href="{{ route('recettes.show', $recette) }}">
            {{ __('interface.cancel') }}
        </a>
    </p>
@endsection
