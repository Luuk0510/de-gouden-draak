<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antwoord extends Model
{
    use HasFactory;

    protected $table = 'antwoorden';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'klant',
        'vraag',
        'antwoord',
        'aangemaakt_op',
        'gewijzigd_op',
        'verwijderd_op',
    ];

    public function klant()
    {
        return $this->belongsTo(Klant::class, 'klant');
    }

    public function vraag()
    {
        return $this->belongsTo(Vraag::class, 'vraag');
    }
}
