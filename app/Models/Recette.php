
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recette extends Model
{
    use HasFactory;

    protected $table = 'Recettes';

    protected $primaryKey = 'idrecette';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'idrecette',
        'idutilisateur',
        'idcategorie',
        'nom',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'idrecette' => 'integer',
            'idutilisateur' => 'integer',
            'idcategorie' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'idutilisateur', 'idUtilisateurs');
    }

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'idcategorie', 'idcategorie');
    }

    public function avis(): HasMany
    {
        return $this->hasMany(Avis::class, 'idrecette', 'idrecette');
    }

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(
            Menu::class,
            'Menu_Recettes',
            'idrecette',
            'idmenu',
            'idrecette',
            'idmenu'
        );
    }
}
