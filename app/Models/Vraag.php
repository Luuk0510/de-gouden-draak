<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vraag extends Model
{
    use HasFactory;

    protected $table = 'vragen';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'vraag',
        'aangemaakt_op',
        'gewijzigd_op',
        'verwijderd_op',
    ];
    
    public function antwoorden()
    {
        return $this->hasMany(Antwoord::class, 'vraag');
    }
}
