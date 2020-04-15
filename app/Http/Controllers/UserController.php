<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserDetailsRequest;
use App\Repository\UserRepository;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $filters = [ 'country' => 'AT', 'active' => true ];

        $users = UserRepository::getFilteredUsers($filters);

        return UserResource::collection($users);
    }

    public function updateDetails(UserDetailsRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $inputs = $request->all();

        return UserRepository::updateUserDetails($user, $inputs);
    }
}
