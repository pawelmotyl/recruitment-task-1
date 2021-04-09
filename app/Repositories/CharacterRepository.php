<?php

namespace App\Repositories;


use App\Models\Character;
use App\Models\Title;

class CharacterRepository
{
    protected $model;

    public function __construct(Character $model)
    {
        $this->model = $model;
    }

    public function all() {
        return $this->model->all();
    }

    public function create(array $attributes) {
        return $this->model->create($attributes);
    }

    public function find(int $id) {
        return $this->model->find($id);
    }

    public function delete(int $id) {
        return $this->model->find($id)->delete();
    }

    public function update(array $attributes, int $id) {
        $character = Character::find($id);
        $character->update($attributes);
        return $this->find($id);
    }

    public function setTitles(array $titles, int $id) {
        $character = Character::find($id);
        foreach ($titles as $title) {
            $character->titles()->save(new Title([
                'title' => $title
            ]));
        }
        return $this->find($id);
    }
}