@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.app')

@section('title', $recette->nom)

@section('content')
    <p>
        <a href="{{ route('recettes.index') }}">
            {{ __('interface.back_recipes') }}
        </a>
    </p>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    <h1>{{ $recette->nom }}</h1>

    @if ($recette->image_path)
        <img
            src="{{ Storage::disk('public')->url($recette->image_path) }}"
            alt="{{ $recette->nom }}"
        >
    @endif

    <p>
        {{ __('interface.author') }} :
        {{ $recette->user?->nom ?? __('interface.unknown_user') }}
    </p>

    <p>
        {{ __('interface.category') }} :
        {{ $recette->categorie?->nom ?? __('interface.no_category') }}
    </p>

    <p>{{ $recette->description }}</p>

    <p>
        <a href="{{ route('recettes.edit', $recette) }}">
            {{ __('interface.edit') }}
        </a>
    </p>

    <form method="post" action="{{ route('recettes.destroy', $recette) }}">
        @csrf
        @method('DELETE')

        <button type="submit">{{ __('interface.delete') }}</button>
    </form>

    <hr>

    <h2>{{ __('interface.reviews') }}</h2>

    @forelse ($recette->avis as $avis)
        <article>
            <p>
                {{ __('interface.rating') }} :
                {{ $avis->note ?? __('interface.no_rating') }}/5
            </p>

            <p>
                {{ __('interface.review_author') }} :
                {{ $avis->user?->nom ?? __('interface.unknown_user') }}
            </p>

            @if ($avis->dateavis)
                <p>
                    {{ __('interface.date') }} :
                    {{ $avis->dateavis->format('d/m/Y') }}
                </p>
            @endif
        </article>

        <hr>
    @empty
        <p>{{ __('interface.no_reviews') }}</p>
    @endforelse
@endsection
