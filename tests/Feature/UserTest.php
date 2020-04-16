<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\ApiTestCase;
use Tests\Utils\UserUtils;

class UserTest extends ApiTestCase
{
    /** @test */
    public function get_active_users_from_russia()
    {        
        $filters = ['active' => 1, 'country' => 'RU'];
        
        $this->getUsers($filters)->assertJsonCount(1, 'data'); 
    }

    /** @test */
    public function get_active_users()
    {        
        $filters = ['active' => 1];
        
        $this->getUsers($filters)->assertJsonCount(5, 'data'); 
    }

    /** @test */
    public function get_all_unactive_users()
    {       
        $filters = ['active' => 0];

        $this->getUsers($filters)->assertJsonCount(2, 'data'); 
    }

    /** @test */
    public function get_all_users()
    {        
        $this->getUsers()->assertJsonCount(7, 'data');
    }

    private function getUsers(array $filters = [])
    {
        return $this->getJson(route('api.users', $filters))
                    ->assertStatus(200)
                    ->assertJsonStructure(UserUtils::$usersStructure);
    }
}
