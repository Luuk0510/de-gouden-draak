<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BestellingStatus extends Model
{
    use HasFactory;

    protected $table = 'bestelling_status';
    protected $primaryKey = 'id';

    protected $fillable = [
        'naam',
    ];

    public function bestellingen()
    {
        return $this->hasMany(Bestelling::class, 'status');
    }
}
