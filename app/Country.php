<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * Get users.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
