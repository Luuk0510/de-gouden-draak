<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CocktailHeeftBestelling extends Model
{
    use HasFactory;

    protected $table = 'cocktails_heeft_bestellingen';
    protected $primaryKey = 'id';

    protected $fillable = [
        'cocktails',
        'bestelling',
    ];
}
