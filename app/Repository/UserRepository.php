<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Builder;
use App\Utils\Response;
use App\User;

class UserRepository
{
    static function getFilteredUsers(array $filters = [])
    {
        $users = User::with('details');

        if(isset($filters['active'])) {
            $users->whereActive($filters['active']);
        }

        if(isset($filters['country'])) {
            $users->whereHas('details.country', function (Builder $query) use ($filters) {
                $query->where('iso2', $filters['country']);
            });
        }

        return $users->get();
    }

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

    static function delete(User $user)
    {
        try {
            if($user->hasDetails()) {
                return Response::error(
                    "the user cannot be deleted because it has details"
                );
            }
    
            $user->delete();

            return Response::success();
        } catch (\Throwable $th) {
            return Response::error($th->getMessage());
        }
    }
}