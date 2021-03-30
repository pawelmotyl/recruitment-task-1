<?php

namespace Tests\Unit;

use App\Models\Character;
use App\Repositories\CharacterRepository;
use Tests\TestCase;

class CharacterRepositoryTest extends TestCase
{
    private $character_repository;

    /**
     *
     */
    public function setUp(): void {
        parent::setUp();
        $this->character_repository = new CharacterRepository(new Character);
    }

    /**
     */
    public function testCreate(){
        $character = $this->character_repository->create([
            'url' => 'url',
            'name' => 'name',
            'gender' => 'gender',
            'culture' => 'culture',
            'born' => 'born',
            'died' => 'died',
            'father' => 'father',
            'mother' => 'mother',
            'spouse' => 'spouse'
        ]);
        $this->assertNotNull($character->id);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFind()
    {
        $character = Character::factory([
            'gender' => 'Male'
        ])->create();
        $character_id = $character->id;
        $found_character = $this->character_repository->find($character_id);

        $this->assertEquals($character_id, $found_character->id);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdate()
    {
        $character = Character::factory([
            'gender' => 'Female'
        ])->create();

        $character_id = $character->id;

        $this->character_repository->update([
            'gender' => 'Male',
            'name' =>  'Motyl',
            'born' => '1999'
        ], $character_id);

        $found_character = $this->character_repository->find($character_id);

        $this->assertEquals('Male', $found_character->gender);
        $this->assertEquals('Motyl', $found_character->name);
        $this->assertEquals('1999', $found_character->born);
    }
}
