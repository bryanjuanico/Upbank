<?php

namespace MHBank\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Release
 */
class Release extends Model
{
    protected $table = 'releases';

    protected $primaryKey = 'release_id';

	public $timestamps = false;

    protected $fillable = [
        'client_id',
        'bloodbag_id',
        'hospital_id',
        'datereleased'
    ];

    protected $guarded = [];

        
}