<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'rollen';
    public $timestamps = false;
    
    protected $fillable = [
        'naam',
        'aangemaakt_op',
        'gewijzigd_op',
        'verwijderd_op',
    ];

    public function gebruikers()
    {
        return $this->hasMany(Gebruiker::class, 'rol');
    }
}
