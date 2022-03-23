<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'event_id' => $this->faker->randomNumber(5, true),
            'event_name' => $this->faker->sentence(3),
            'start_at' => $this->faker->dateTime(),
            'end_at' => $this->faker->dateTime(),
            'event_desc' => $this->faker->paragraph(),
            'user_id' => mt_rand(1, 15),
            'unit_id' => mt_rand(1, 9),
            'budget' => $this->faker->randomNumber(5, true),
            'image' => 'A',
            'pdf' => 'A',

        ];
    }
}
