<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\ApiTestCase;
use Tests\Utils\UserUtils;

class UserTest extends ApiTestCase
{
    /** @test */
    public function get_all_users()
    {        
        $this->getUsers()->assertJsonCount(7, 'data');
    }

    /** @test */
    public function get_active_users()
    {        
        $filters = ['active' => 1];
        
        $this->getUsers($filters)->assertJsonCount(5, 'data'); 
    }

    /** @test */
    public function get_inactive_users()
    {       
        $filters = ['active' => 0];

        $this->getUsers($filters)->assertJsonCount(2, 'data'); 
    }

    /** @test */
    public function get_all_users_from_austria()
    {        
        $filters = ['country' => 'AT'];
        
        $this->getUsers($filters)->assertJsonCount(3, 'data'); 
    }

    /** @test */
    public function get_active_users_from_russia()
    {        
        $filters = ['active' => 1, 'country' => 'RU'];
        
        $this->getUsers($filters)->assertJsonCount(1, 'data'); 
    }

    /** @test */
    public function get_an_error_if_the_country_is_not_in_the_db()
    {        
        $filters = ['country' => 'DO'];
        
        $this->getJson(route('api.users', $filters))
                    ->assertStatus(422)
                    ->assertJsonFragment([
                        'errors' => [
                            'country' => ['The selected country is invalid.']
                        ]
                    ]);
    }

    /** @test */
    public function get_an_error_if_an_invalid_active_value_is_sent()
    {        
        $filters = ['active' => 'this is a bad value'];
        
        $this->getJson(route('api.users', $filters))
                    ->assertStatus(422)
                    ->assertJsonFragment([
                        'errors' => [
                            'active' => ['The active field must be true or false.']
                        ]
                    ]);
    }

    private function getUsers(array $filters = [])
    {
        return $this->getJson(route('api.users', $filters))
                    ->assertStatus(200)
                    ->assertJsonStructure(UserUtils::$usersStructure);
    }
}
