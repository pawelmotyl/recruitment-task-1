<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CharacterApiTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:refresh');
        Artisan::call('characters:download');
    }

    /**
     * Test listing of characters.
     *
     * @return void
     */
    public function testListCharactersTest()
    {
        $response = $this->get('/api/characters');

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
        $response = $this->get('/api/characters/1');

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
}
