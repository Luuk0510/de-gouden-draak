<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GerechtHeeftBestelling extends Model
{
    use HasFactory;

    protected $table = 'gerechten_heeft_bestellingen';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'bestelling',
        'gerecht',
        'rijst_soort',
        'deel',
        'opmerkingen',
    ];

    public function gerecht()
    {
        return $this->belongsTo(Gerecht::class, 'gerecht', 'id');
    }
    
}