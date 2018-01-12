<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Bloodstorage
 */
class Bloodstorage extends Model
{
    protected $table = 'bloodstorage';

    protected $primaryKey = 'bloodstorage_id';

    public $incrementing = false;

	public $timestamps = false;

    protected $fillable = [
        'donation_id',
        'component',
        'status',
        'release_id',
        'expirydate'
    ];

    protected $guarded = [];
}