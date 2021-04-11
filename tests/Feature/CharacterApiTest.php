<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CharacterApiTest extends TestCase
{

    use RefreshDatabase;


    private $headers;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:refresh');
        Artisan::call('characters:download');
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

        $response = $this->post('/api/login', [
            'email' => 'motyl@motyl.it',
            'password' => 'motyl'
        ]);

        $this->headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $response->json()['token'],
        ];
    }

    /**
     * Test listing of characters.
     *
     * @return void
     */
    public function testListCharactersTest()
    {


        $response = $this->withHeaders($this->headers)
            ->get('/api/characters');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'url',
                    'name',
                    'gender',
                    'culture',
                    'born',
                    'died',
                    'father',
                    'mother',
                    'spouse',
                    'titles' => [
                        '*' => [
                            'title'
                        ]
                    ]
                ]
            ]
        ]);
    }
    /**
     * Test showing character
     *
     * @return void
     */
    public function testShowCharacterTest()
    {
        $response = $this->withHeaders($this->headers)
            ->get('/api/characters/1');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'url',
                'name',
                'gender',
                'culture',
                'born',
                'died',
                'father',
                'mother',
                'spouse',
                'titles' => [
                    '*' => [
                        'title'
                    ]
                ]
            ]
        ]);
    }

    /**
     * Tests updating of a character
     */
    public function testUpdateCharacterTest(){
        $response = $this->withHeaders($this->headers)
            ->put('/api/characters/1', [
            'url' => 'http://test.url',
            'name' => 'name',
            'gender' => 'gender',
            'culture' => 'culture',
            'born' => 'born',
            'died' => 'died',
            'father' => 'father',
            'mother' => 'mother',
            'spouse' => 'spouse',
            'titles' => [
                'title'
            ]
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'url',
                'name',
                'gender',
                'culture',
                'born',
                'died',
                'father',
                'mother',
                'spouse',
                'titles' => [
                    '*' => [
                        'title'
                    ]
                ]
            ]
        ]);

        $data = $response->json()['data'];
        $this->assertEquals($data['url'], 'http://test.url');
        $this->assertEquals($data['name'], 'name');
        $this->assertEquals($data['gender'], 'gender');
        $this->assertEquals($data['culture'], 'culture');
        $this->assertEquals($data['born'], 'born');
        $this->assertEquals($data['died'], 'died');
        $this->assertEquals($data['mother'], 'mother');
        $this->assertEquals($data['spouse'], 'spouse');
    }

    /**
     * Tests failing of updating character.
     * Fails because gender has length limit 10
     */
    public function testUpdateCharacterFailingTest(){
        $response = $this->withHeaders($this->headers)
            ->put('/api/characters/1', [
            'url' => 'http://test.url',
            'name' => 'name',
            'gender' => 'gender gender gender gender gender',
            'culture' => 'culture',
            'born' => 'born',
            'died' => 'died',
            'father' => 'father',
            'mother' => 'mother',
            'spouse' => 'spouse',
            'titles' => [
                'title'
            ]
        ]);

        $response->assertStatus(500);
    }
}
