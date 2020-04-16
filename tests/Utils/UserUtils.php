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

    static function removeUsersByCountry(string $country) : void
    {
        $users = UserRepository::getFilteredUsers(compact('country'));

        $users->each(function ($user) {
            $user->delete();
        });
    }
}

