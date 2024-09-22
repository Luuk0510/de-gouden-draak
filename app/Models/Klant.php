<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klant extends Model
{
    use HasFactory;

    protected $table = 'klanten';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'bestelling',
        'voornaam',
        'tussenvoegsel',
        'achternaam',
        'geboortedatum',
        'aangemaakt_op',
        'gewijzigd_op',
        'verwijderd_op',
    ];

    public function bestelling()
    {
        return $this->belongsTo(Bestelling::class, 'bestelling', 'id');
    }
}
