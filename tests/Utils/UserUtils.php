<?php

namespace Tests\Utils;

use App\Services\UserService;

class UserUtils
{
    static $usersStructure = [
        'data' => [
            [
                'type',
                'attributes' => [
                    'email',
                    'active'
                ],
                'id'
            ]
        ]
    ];

    /**
     * 
     * Remove all users from a country
     * 
     * @param string $country. example 'AT'
     * 
     * @return void
     */
    static function removeUsersByCountry(string $country) : void
    {
        $users = UserService::getUsersByFilters(compact('country'));

        $users->each(function ($user) {
            $user->delete();
        });
    }
}

