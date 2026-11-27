<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class RecetteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->idrecette,
            'nom' => $this->nom,
            'description' => $this->description,
            'image_url' => $this->image_path
                ? Storage::disk('public')->url($this->image_path)
                : null,
            'categorie' => $this->whenLoaded('categorie', fn () => [
                'id' => $this->categorie->idcategorie,
                'nom' => $this->categorie->nom,
            ]),
            'auteur' => $this->whenLoaded('user', fn () => [
                'id' => $this->user->idUtilisateurs,
                'nom' => $this->user->nom,
            ]),
        ];
    }
}