<?php

namespace MHBank\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Bloodstorage
 */
class Bloodstorage extends Model
{
    protected $table = 'bloodstorage';

    protected $primaryKey = 'bloodstorage_id';

	public $timestamps = false;

    protected $fillable = [
        'donation_id',
        'component',
        'status'
    ];

    protected $guarded = [];

    public function whichDonation() {
    	return $this->belongsTo('MHBank\Models\Donation');
    }
        
}