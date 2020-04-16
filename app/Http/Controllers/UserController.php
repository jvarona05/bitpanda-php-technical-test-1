<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Requests\UserDetailsRequest;
use App\Repository\UserRepository;
use App\Http\Requests\UserFiltersRequest;
use App\User;

class UserController extends Controller
{
    public function index(UserFiltersRequest $request)
    {
        $filters = $request->all();

        $users = UserRepository::getFilteredUsers($filters);

        return UserResource::collection($users);
    }

    public function getAustrianUsers()
    {
        $filters = [ 'country' => 'AT', 'active' => true ];

        $users = UserRepository::getFilteredUsers($filters);

        return UserResource::collection($users);
    }

    public function updateDetails(UserDetailsRequest $request, int $id)
    {
        $user = User::findOrFail($id);

        $inputs = $request->all();

        return UserRepository::updateUserDetails($user, $inputs);
    }

    public function delete(int $id)
    {
        $user = User::findOrFail($id);

        return UserRepository::delete($user);
    }
}
