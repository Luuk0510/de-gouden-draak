<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cocktail extends Model
{
    use HasFactory;

    protected $table = 'cocktails';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'naam',
        'afbeelding',
        'prijs',
        'beschrijving',
        'aangemaakt_op',
        'gewijzigd_op',
        'verwijderd_op',
    ];
}
