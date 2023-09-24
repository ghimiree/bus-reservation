<?php

namespace Database\Factories;

use App\Models\Seat;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeatFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Seat::class;

    public function definition()
    {

        return [];
    }
}
