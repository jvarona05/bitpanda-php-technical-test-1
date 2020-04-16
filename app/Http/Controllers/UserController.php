<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Requests\UserDetailsRequest;
use App\Repository\UserRepository;
use App\Http\Requests\UserFiltersRequest;
use App\User;

/**
 * @group Users
 */
class UserController extends Controller
{
    /**
     * Get Users 
     * 
     * Returns users filtered by country and status.
     *  
     * @queryParam country Country iso2 code. Example: RU
     * 
     * @queryParam active The user status. Example: 1
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(UserFiltersRequest $request)
    {
        $filters = $request->all();

        $users = UserRepository::getFilteredUsers($filters);

        return UserResource::collection($users);
    }

    /**
     * Get Austrian Users 
     * 
     * Returns all the users which are `active` (users table) and have an Austrian citizenship.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getAustrianUsers()
    {
        $filters = [ 'country' => 'AT', 'active' => true ];

        $users = UserRepository::getFilteredUsers($filters);

        return UserResource::collection($users);
    }

    /**
     * Update User Details
     * 
     * It will allow you to edit user details just if the user details are there already.
     * 
     * @urlParam id required The User ID. Example: 1
     * 
     * @bodyParam citizenship_country_id int required Country id. Example: 2
     * @bodyParam first_name string required User Firstname. Example: Jose Manuel
     * @bodyParam last_name string required User Lastname. Example: Rodriguez Varona
     * @bodyParam phone_number string required User Phonenumber. Example: 000000000
     *
     * @response {"success":true,"message":"Succesfully"}
     * 
     * @response 500 {"success":false,"message":"The user doesn't have details"}
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateDetails(UserDetailsRequest $request, int $id)
    {
        $user = User::findOrFail($id);

        $inputs = $request->all();

        return UserRepository::updateUserDetails($user, $inputs);
    }

    /**
     * Delete User
     * 
     * It will allow you to delete a user just if no user details exist yet.
     * 
     * @urlParam id required The User ID.
     * 
     * @response {"success":true,"message":"Succesfully"}
     * 
     * @response 500 {"success":false,"message":"The user cannot be deleted because it has details"}
     * 
     * @return \Illuminate\Http\Response
     */
    public function delete(int $id)
    {
        $user = User::findOrFail($id);

        return UserRepository::delete($user);
    }
}
