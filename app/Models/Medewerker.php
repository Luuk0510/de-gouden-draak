<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medewerker extends Model
{
    use HasFactory;

    protected $table = 'medewerkers';
    protected $primaryKey = 'id';
    public $timestamps = true; 

    const CREATED_AT = 'aangemaakt_op';
    const UPDATED_AT = 'gewijzigd_op';

    protected $fillable = [
        'gebruikersnaam',
        'voornaam',
        'tussenvoegsel',
        'achternaam',
        'aangemaakt_op',
        'gewijzigd_op',
        'verwijdert_op',
    ];
    
    public function gebruiker()
    {
        return $this->belongsTo(Gebruiker::class, 'gebruikersnaam');
    }
}
