<?php

namespace Database\Factories;

use App\Models\Character;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Character::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => $this->faker->url,
            'name' => $this->faker->name,
            'gender' => $this->faker->name,
            'culture' => $this->faker->name,
            'born' => $this->faker->name,
            'died' => $this->faker->name,
            'father' => $this->faker->name,
            'mother' => $this->faker->name,
            'spouse' => $this->faker->name
        ];
    }
}
