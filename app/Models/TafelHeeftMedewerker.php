<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TafelHeeftMedewerker extends Model
{
    use HasFactory;

    public $timestamps = false; 
    protected $table = 'tafels_heeft_medewerkers';

    protected $fillable = [
        'tafel',
        'medewerker',
        'datum',
    ];
}
