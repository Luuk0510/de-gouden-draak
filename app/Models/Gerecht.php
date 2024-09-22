<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gerecht extends Model
{
    use HasFactory;

    protected $table = 'gerechten';
    protected $primaryKey = 'id';
    public $timestamps = true; 

    const CREATED_AT = 'aangemaakt_op';
    const UPDATED_AT = 'gewijzigd_op';

    protected $fillable = [
        'nummer',
        'soort',
        'aanbieding',
        'naam',
        'prijs',
        'beschrijving',
        'aangemaakt_op',
        'gewijzigd_op',
        'verwijderd_op',
    ];

    public function soort()
    {
        return $this->belongsTo(GerechtSoort::class, 'soort');
    }

    public function aanbieding()
    {
        return $this->belongsTo(Aanbieding::class, 'aanbieding');
    }

    public function bestellingen()
    {
        return $this->belongsToMany(Bestelling::class, 'gerechten_heeft_bestellingen', 'gerecht', 'bestelling');
    }

    public function opmerkingen()
    {
        return $this->hasMany(GerechtHeeftBestelling::class, 'gerecht', 'id')->whereNotNull('opmerkingen');
    }    
}
