<?php

namespace Tests\Unit;

use App\Models\Character;
use App\Repositories\CharacterRepository;
use Tests\TestCase;

class CharacterRepositoryTest extends TestCase
{
    private $character_repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->character_repository = new CharacterRepository(new Character);
    }

    public function testCreate()
    {
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

    public function testFind()
    {
        $character = Character::factory([
            'gender' => 'Male'
        ])->create();
        $character_id = $character->id;
        $found_character = $this->character_repository->find($character_id);

        $this->assertEquals($character_id, $found_character->id);
    }

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

    public function testDelete()
    {
        $character = Character::factory([
            'gender' => 'Female'
        ])->create();
        $character_id = $character->id;
        $this->assertTrue($this->character_repository->delete($character_id));
        $found_character = $this->character_repository->find($character_id);
        $this->assertNull($found_character);
    }

    public function testSetTitles()
    {
        $character = Character::factory([
            'gender' => 'Female'
        ])->create();
        $character_id = $character->id;
        $this->character_repository->setTitles([
            'title 1', 'title 2'
        ], $character_id);

        $found_character = $this->character_repository->find($character_id);
        $this->assertEquals('title 1', $found_character->titles->toArray()[0]['title']);
        $this->assertEquals('title 2', $found_character->titles->toArray()[1]['title']);
        $this->assertFalse(isset($found_character->titles->toArray()[2]));
    }
}
