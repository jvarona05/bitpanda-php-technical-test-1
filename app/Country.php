<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * Get user details.
     */
    public function userDetails()
    {
        return $this->hasMany(UserDetail::class, 'citizenship_country_id');
    }
}
