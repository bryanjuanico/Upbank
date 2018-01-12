<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Donation
 */
class Donation extends Model
{
    protected $table = 'donation';

    protected $primaryKey = 'donation_id';

	public $timestamps = false;

    protected $fillable = [
        'client_id',
        'datedonated',
        'staff_id'
    ];

    protected $guarded = [];
}