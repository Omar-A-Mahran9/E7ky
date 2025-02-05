<?php

namespace Database\Factories;

use App\Models\Agenda;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgendaFactory extends Factory
{
    protected $model = Agenda::class;

    public function definition()
    {
        return [
            'name_ar' => $this->faker->word(),
            'name_en' => $this->faker->word(),
            'description_ar' => $this->faker->text(),
            'description_en' => $this->faker->text(),
            'start_day' => $this->faker->date(),
            'end_day' => $this->faker->optional()->date(),
            'start_time' => $this->faker->dateTime(),
            'end_time' => $this->faker->optional()->dateTime(),
            'event_id' => Event::inRandomOrder()->first()->id, // Ensure you're getting a single event ID
        ];
    }
}
