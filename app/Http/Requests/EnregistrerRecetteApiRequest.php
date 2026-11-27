<?php

namespace App\Http\Requests;

use App\Models\Recette;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class EnregistrerRecetteApiRequest extends FormRequest
{
    public function authorize(): bool
    {
        if ($this->isMethod('post')) {
            return Gate::allows('create', Recette::class);
        }

        return Gate::allows('update', $this->route('recette'));
    }

    public function rules(): array
    {
        $presence = $this->isMethod('post') ? 'required' : 'sometimes';

        return [
            'nom' => [$presence, 'string', 'max:120'],
            'description' => [$presence, 'string', 'max:5000'],
            'idcategorie' => ['sometimes', 'nullable', 'integer', 'exists:Categories,idcategorie'],
            'image' => ['sometimes', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}