<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
    ];

    /**
     * Get user details.
     */
    public function details()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function hasDetails()
    {
        return (bool) $this->details;
    }

    /**
    podemos probar esto para las fechas
    // Model
    protected $dates = ['ordered_at', 'created_at', 'updated_at'];
    public function getSomeDateAttribute($date)
    {
        return $date->format('m-d');
    }

    // View
    {{ $object->ordered_at->toDateString() }}
    {{ $object->ordered_at->some_date }}
    */
}
