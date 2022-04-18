<?php

namespace Database\Factories\Problemmodels;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Problemmodels\Language;

class LanguageFactory extends Factory
{
    protected $model = Language::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'language_name'=> $this->faker->name(),
            'version'=>$this->faker->randomFloat()
        ];
    }
}
