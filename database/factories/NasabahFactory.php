<?php

namespace Database\Factories;

use App\Models\Nasabah;
use Illuminate\Database\Eloquent\Factories\Factory;

class NasabahFactory extends Factory
{
    protected $model = Nasabah::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
