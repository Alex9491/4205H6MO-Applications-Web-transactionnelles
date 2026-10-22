<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'Utilisateurs';

    protected $primaryKey = 'idUtilisateurs';

    public $timestamps = false;

    protected $fillable = [
        'nom',
        'courriel',
        'motdepasse',
        'role',
    ];

    protected $hidden = [
        'motdepasse',
    ];

    protected function casts(): array
    {
        return [
            'motdepasse' => 'hashed',
        ];
    }

    public function avis(): HasMany
    {
        return $this->hasMany(Avis::class, 'idutilisateur', 'idUtilisateurs');
    }

    public function recettes(): HasMany
    {
        return $this->hasMany(Recette::class, 'idutilisateur', 'idUtilisateurs');
    }
}
