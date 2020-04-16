<?php

namespace App\Repository;

use Illuminate\Http\Response as LaravelResponse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use App\Utils\Response;
use App\User;

class UserRepository
{
    /**
     * Returns User Colection filtered by user country and status
     * 
     * @param array $filters. example ['active' => true, 'country' => 'AT']
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    static function getFilteredUsers(array $filters = []) : Collection
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

    /**
     * Update user details if the user has it
     * 
     * @param User $user.
     * @param array $userDetails. example ['citizenship_country_id' => 1, 'first_name' => 'José', 'last_name' =>'Rodriguez', 'phone_number' => '000']
     * 
     * @return \Illuminate\Http\Response
     */
    static function updateUserDetails(User $user, array $userDetails) : LaravelResponse
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

    /**
     * Delete a user if it doesn't have user_details
     * 
     * @param User $user.
     * 
     * @return \Illuminate\Http\Response
     */
    static function delete(User $user) : LaravelResponse
    {
        try {
            if($user->hasDetails()) {
                return Response::error(
                    "The user cannot be deleted because it has details"
                );
            }
    
            $user->delete();

            return Response::success();
        } catch (\Throwable $th) {
            return Response::error($th->getMessage());
        }
    }
}