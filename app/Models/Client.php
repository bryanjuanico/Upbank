<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 */
class Client extends Model
{
    protected $table = 'client';

    protected $primaryKey = 'client_id';

	public $timestamps = false;

    protected $fillable = [
        'client_type',
        'client_name',
        'client_bloodtype',
        'client_gender',
        'client_age',
        'client_dob',
        'client_address',
        'mobile',
        'telephone',
        'email'
    ];

    protected $guarded = [];

    public function donations()
    {
        return $this->hasMany('App\Models\Donation');
    }
}