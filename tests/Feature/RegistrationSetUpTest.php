<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Laravel\Passport\Passport;

class RegistrationSetUpTest extends TestCase
{
    use RefreshDatabase;

        function test_it_creates_default_categories_on_user_creation()
    {
        $this->createClient();
        $this->graphQL('
            mutation {
                register(input: {
                    name:"ivan"
    email:"ivan@mail.com"
    password:"123456789"
    password_confirmation:"123456789"
                })
                {
                    status
                }
            }
        ');
        $user = User::first();
        $this->assertEquals(6, $user->categories->count());
    }
}
