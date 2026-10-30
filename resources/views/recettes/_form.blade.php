@csrf

<label for="nom">{{ __('interface.name') }}</label>
<input
    id="nom"
    name="nom"
    value="{{ old('nom', $recette?->nom) }}"
>
@error('nom')
    <p>{{ $message }}</p>
@enderror

<label for="description">{{ __('interface.description') }}</label>
<textarea id="description" name="description">{{ old('description', $recette?->description) }}</textarea>
@error('description')
    <p>{{ $message }}</p>
@enderror

<label for="idcategorie">{{ __('interface.category') }}</label>
<select id="idcategorie" name="idcategorie">
    <option value="">{{ __('interface.choose_category') }}</option>

    @foreach ($categories as $categorie)
        <option
            value="{{ $categorie->idcategorie }}"
            @selected(old('idcategorie', $recette?->idcategorie) == $categorie->idcategorie)
        >
            {{ $categorie->nom }}
        </option>
    @endforeach
</select>
@error('idcategorie')
    <p>{{ $message }}</p>
@enderror

<label for="image">{{ __('interface.image') }}</label>
<input
    id="image"
    name="image"
    type="file"
    accept="image/jpeg,image/png,image/webp"
>
@error('image')
    <p>{{ $message }}</p>
@enderror

<button type="submit">{{ __('interface.save') }}</button>
