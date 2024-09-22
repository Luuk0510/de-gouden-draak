<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aanbieding extends Model
{
    use HasFactory;

    protected $table = 'aanbiedingen';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'korting_percentage',
        'begin_datum',
        'eind_datum',
        'aangemaakt_op',
        'gewijzigd_op',
        'verwijderd_op',
    ];

    public function gerechten()
    {
        return $this->hasMany(Gerecht::class, 'aanbieding');
    }
}
