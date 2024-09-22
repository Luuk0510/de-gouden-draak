<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GerechtSoort extends Model
{
    use HasFactory;

    protected $table = 'gerecht_soort';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'naam',
        'aangemaakt_op',
        'gewijzigd_op',
        'verwijderd_op',
    ];

    public function gerechten()
    {
        return $this->hasMany(Gerecht::class, 'soort');
    }    
}
