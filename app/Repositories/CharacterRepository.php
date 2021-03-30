<?php

namespace App\Repositories;


use App\Models\Character;

class CharacterRepository
{
    protected $model;

    public function __construct(Character $model)
    {
        $this->model = $model;
    }

    public function all() {
        $all = $this->model->all();
        echo(print_r($all, true));
    }

    public function create(array $attributes) {
        return Character::create($attributes);
    }

    public function find(int $id) {
        return Character::find($id);
    }

    public function update(array $attributes, int $id) {
        $character = Character::find($id);
        $character->update($attributes);
        return $this->find($id);
    }
}