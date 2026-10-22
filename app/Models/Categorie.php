<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends Model
{
    use HasFactory;

    protected $table = 'Categories';

    protected $primaryKey = 'idcategorie';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'nom',
    ];

    public function recettes(): HasMany
    {
        return $this->hasMany(
            Recette::class,
            'idcategorie',
            'idcategorie'
        );
    }
}
