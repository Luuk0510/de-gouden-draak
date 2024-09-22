<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tafel extends Model
{
    use HasFactory;

    protected $table = 'tafels';
    protected $primaryKey = 'id';
    public $timestamps = true; 

    const CREATED_AT = 'aangemaakt_op';
    const UPDATED_AT = 'gewijzigd_op';

    protected $fillable = [
        'capiciteit',
        'aangemaakt_op',
        'gewijzigd_op',
        'verwijderd_op',
    ];

    public function bestellingen()
    {
        return $this->hasMany(Bestelling::class, 'tafel_nummer');
    }

    public function medewerkers()
    {
        return $this->belongsToMany(Medewerker::class, 'tafels_heeft_medewerkers', 'tafel', 'medewerker');
    }
}
