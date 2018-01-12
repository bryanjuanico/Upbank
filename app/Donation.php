<?php

namespace MHBank\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Donation
 */
class Donation extends Model
{
    protected $table = 'donations';

    protected $primaryKey = 'donation_id';

	public $timestamps = false;

    protected $fillable = [
        'client_id',
        'datedonated'
    ];

    protected $guarded = [];

    public function donor() {
        return $this->belongsTo('App\Models\Client');
    }

    public function bloodbags() {
        return $this->hasMany('App\Models\Bloodstorage');
    }
}