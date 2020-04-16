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
        $filters = ['active' => 'This is a bad value'];
        
        $this->getJson(route('api.users', $filters))
                    ->assertStatus(422)
                    ->assertJsonFragment([
                        'errors' => [
                            'active' => ['The active field must be true or false.']
                        ]
                    ]);
    }

    /** @test */
    public function get_active_users_from_austria()
    {                
        $this->getJson(route('api.austria.users'))
                    ->assertStatus(200)
                    ->assertJsonCount(2, 'data')
                    ->assertJsonStructure(UserUtils::$usersStructure)
                    ->assertJsonPath('data.0.id', 1)
                    ->assertJsonPath('data.1.id', 6);
    }

    /** @test */
    public function get_empty_array_when_no_austrian_users_in_the_db()
    {                
        UserUtils::removeUsersByCountry('AT');

        $this->getJson(route('api.austria.users'))
                    ->assertStatus(200)
                    ->assertJsonCount(0, 'data');
    }

    /** @test */
    public function can_update_user_details()
    {          
        $details = [
            'citizenship_country_id' => 1,
            'first_name' => 'José Manuel',
            'last_name' => 'Rodríguez Varona',
            'phone_number' => '000000000'
        ];
        
        $this->putJson(route('api.update.user.details', ['id' => 1]), $details)
                    ->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        'message' => 'Succesfully'
                    ]);;
    }

    /** @test */
    public function cannot_update_user_details_if_the_country_is_not_in_the_db()
    {          
        $details = [
            'citizenship_country_id' => 10000,
            'first_name' => 'José Manuel',
            'last_name' => 'Rodríguez Varona',
            'phone_number' => '000000000'
        ];
        
        $this->putJson(route('api.update.user.details', ['id' => 1]), $details)
                    ->assertStatus(422)
                    ->assertJsonFragment([
                        'errors' => [
                            'citizenship_country_id' => [
                                'The selected citizenship country id is invalid.'
                            ]
                        ]
                    ]);
    }

    /** @test */
    public function cannot_update_user_details_if_not_all_required_fields_are_sent()
    {          
        $details = [];
        
        $this->putJson(route('api.update.user.details', ['id' => 1]), $details)
                    ->assertStatus(422)
                    ->assertJsonFragment([
                        'errors' => [
                            'citizenship_country_id' => [
                                'The citizenship country id field is required.'
                            ],
                            'first_name' => [
                                'The first name field is required.'
                            ],
                            'last_name' => [
                                'The last name field is required.'
                            ],
                            'phone_number' => [
                                'The phone number field is required.'
                            ]
                        ]
                    ]);
    }

    /** @test */
    public function cannot_update_user_details_if_the_user_has_no_details()
    {        
        //poner eso en un factory  
        $details = [
            'citizenship_country_id' => 1,
            'first_name' => 'José Manuel',
            'last_name' => 'Rodríguez Varona',
            'phone_number' => '000000000'
        ];
        
        $this->putJson(route('api.update.user.details', ['id' => 2]), $details)
                ->assertStatus(500)
                ->assertJson([
                    'success' => false,
                    'message' => "The user doesn't have details"
                ]);
    }

    /** @test */
    public function get_not_found_if_the_user_id_is_incorrect()
    {        
        $id = 'This is an incorrect id';
        
        $this->putJson(route('api.update.user.details', compact('id')))
                ->assertStatus(404);
    }

    /** @test */
    public function can_delete_an_user()
    {                
        $this->deleteJson(route('api.delete.user', ['id' => 2]))
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => "Succesfully"
            ]);
    }

    /** @test */
    public function cannot_delete_an_user_if_it_has_details()
    {                
        $this->deleteJson(route('api.delete.user', ['id' => 1]))
            ->assertStatus(500)
            ->assertJson([
                'success' => false,
                'message' => "The user cannot be deleted because it has details"
            ]);
    }

    private function getUsers(array $filters = [])
    {
        return $this->getJson(route('api.users', $filters))
                    ->assertStatus(200)
                    ->assertJsonStructure(UserUtils::$usersStructure);
    }
}
