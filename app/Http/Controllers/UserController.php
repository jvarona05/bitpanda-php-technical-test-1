<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserDetailsRequest;
use App\Repository\UserRepository;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        return User::active()->country('AT')->get();
    }

    public function updateDetails(UserDetailsRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $inputs = $request->all();

        return UserRepository::updateUserDetails($user, $inputs);
    }
}
