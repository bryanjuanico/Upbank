<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Release
 */
class Release extends Model
{
    protected $table = 'release';

    protected $primaryKey = 'release_id';

	public $timestamps = false;

    protected $fillable = [
        'client_id',
        'hospital_id',
        'diagnosis',
        'datereleased',
        'staff_id'
    ];

    protected $guarded = [];

        
}