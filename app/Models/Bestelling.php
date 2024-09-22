<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bestelling extends Model
{
    use HasFactory;

    protected $table = 'bestellingen';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $dates = ['datum'];

    protected $fillable = [
        'status',
        'tafel_nummer',
        'ronde',
        'datum',
        'aangemaakt_op',
        'gewijzigd_op',
        'verwijderd_op',
    ];

    public function gerechtenHeeftBestelling()
    {
        return $this->hasMany(GerechtHeeftBestelling::class, 'bestelling', 'id');
    }
    
    public function gerecht()
    {
        return $this->belongsTo(Gerecht::class, 'gerecht', 'id');
    }

    public function klanten()
    {
        return $this->hasMany(Klant::class, 'bestelling', 'id');
    }

    public function klantMetNaam()
    {
        return $this->hasOne(Klant::class)
                    ->whereNotNull('voornaam')
                    ->whereNotNull('achternaam');
    }
    
}
