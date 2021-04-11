<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:refresh');
        DB::table('users')->insert([
            'name'=>'motyl',
            'email'=>'motyl@motyl.it',
            'password'=>Hash::make('motyl')
        ]);
        DB::table('oauth_clients')->insert([
            'secret'=>'n89AeBXsBIvtfYyczmCnJztQY7sRqA4rQDhEJQsv',
            'name' => 'test',
            'redirect' => 'http://localhost:8000',
            'personal_access_client'=>1,
            'password_client' => 0,
            'revoked' => 0,
            'id'=>1
        ]);
    }

    /**
     * Test login route.
     *
     * @return void
     */
    public function testLoginTest()
    {
        $response = $this->post('/api/login', [
            'email' => 'motyl@motyl.it',
            'password' => 'motyl'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'token'
        ]);
    }
}
