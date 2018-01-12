<?php

namespace MHBank\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hospital
 */
class Hospital extends Model
{
    protected $table = 'hospitals';

    protected $primaryKey = 'hospital_id';

	public $timestamps = false;

    protected $fillable = [
        'hospital_name',
        'location'
    ];

    protected $guarded = [];

        
}