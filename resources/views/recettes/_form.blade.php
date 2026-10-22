@csrf

<label for="nom">Nom</label>
<input
    id="nom"
    name="nom"
    value="{{ old('nom', $recette?->nom) }}"
>
@error('nom')
    <p>{{ $message }}</p>
@enderror

<label for="description">Description</label>
<textarea id="description" name="description">{{ old('description', $recette?->description) }}</textarea>
@error('description')
    <p>{{ $message }}</p>
@enderror

<label for="idcategorie">Catégorie</label>
<select id="idcategorie" name="idcategorie">
    <option value="">Choisir une catégorie</option>
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

<button type="submit">Enregistrer</button>
