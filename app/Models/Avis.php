<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Avis extends Model
{
    use HasFactory;

    protected $table = 'Avis';

    protected $primaryKey = 'idavis';

    public $timestamps = false;

    protected $fillable = [
        'idutilisateur',
        'idrecette',
        'note',
        'dateavis',
    ];

    protected function casts(): array
    {
        return [
            'note' => 'integer',
            'dateavis' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'idutilisateur', 'idUtilisateurs');
    }

    public function recette(): BelongsTo
    {
        return $this->belongsTo(Recette::class, 'idrecette', 'idrecette');
    }
}
