<?php

namespace App\Repository;

use App\Utils\Response;
use App\User;

class UserRepository
{
    static function updateUserDetails(User $user, array $userDetails)
    {
        try {
            if(!$user->hasDetails()) {
                return Response::error("The user doesn't have details");
            }
    
            $user->details->update($userDetails);

            return Response::success();
        } catch (\Throwable $th) {
            return Response::error($th->getMessage());
        }
    }
}