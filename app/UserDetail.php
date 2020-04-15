<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'citizenship_country_id',
        'first_name',
        'last_name',
        'phone_number'
    ];

    /**
     * Get the user that owns the details.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get user country.
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'citizenship_country_id');
    }
}
