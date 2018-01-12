<?php

namespace MHBank\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 */
class Client extends Model
{
    protected $table = 'clients';

    protected $primaryKey = 'client_id';

	public $timestamps = false;

    protected $fillable = [
        'client_type',
        'client_name',
        'client_bloodtype',
        'client_address',
        'client_age',
        'client_dob',
        'mobile',
        'telnum',
        'email'
    ];

    protected $guarded = [];

    public function donations() {
        return $this->hasMany('MHBank\Models\Donation');
    }

    public function bloodbagsDonatedByClient() {
        return $this->hasManyThrough('MHBank\Models\BloodStorage', 'MHBank\Models\Donation');
    }
}