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
        $this->getJson(route('api.users'))
            ->assertStatus(200)
            ->assertJsonStructure(UserUtils::$usersStructure);
    }
}
