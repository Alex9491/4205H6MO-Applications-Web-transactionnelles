<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'Menus';

    protected $primaryKey = 'idmenu';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'idmenu',
        'idutilisateur',
        'nom',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'idmenu' => 'integer',
            'idutilisateur' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'idutilisateur',
            'idUtilisateurs'
        );
    }

    public function recettes(): BelongsToMany
    {
        return $this->belongsToMany(
            Recette::class,
            'Menu_Recettes',
            'idmenu',
            'idrecette',
            'idmenu',
            'idrecette'
        );
    }
}
