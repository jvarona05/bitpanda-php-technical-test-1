<?php

namespace Tests\Utils;

use App\Repository\UserRepository;

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
        $users = UserRepository::getFilteredUsers(compact('country'));

        $users->each(function ($user) {
            $user->delete();
        });
    }
}

