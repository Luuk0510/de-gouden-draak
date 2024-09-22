<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Gebruiker extends Authenticatable
{
    use HasFactory;

    protected $table = 'gebruikers';
    protected $primaryKey = 'gebruikersnaam';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false; 

    protected $fillable = [
        'gebruikersnaam',
        'rol',
        'wachtwoord',
        'aangemaakt_op',
        'gewijzigd_op',
        'verwijderd_op',
    ];

    protected $hidden = [
        'wachtwoord',
    ];

    public function setWachtwoordAttribute($value)
    {
        $this->attributes['wachtwoord'] = Hash::make($value);
    }

    public function getAuthPassword()
    {
        return $this->wachtwoord;
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol');
    }

    public function medewerker()
    {
        return $this->hasOne(Medewerker::class, 'gebruikersnaam');
    }
}
