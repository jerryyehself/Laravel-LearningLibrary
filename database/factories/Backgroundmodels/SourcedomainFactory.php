<?php

namespace Database\Factories\Backgroundmodels;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Backgroundmodels\Sourcedomain;
use phpDocumentor\Reflection\Types\Boolean;

class SourcedomainFactory extends Factory
{
    protected $model = Sourcedomain::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'domain_url' => $this->faker->domainName(),
            'domain_name' => $this->faker->domainName(),
            'domain_api' => $this->faker->url(),
            'domain_logo' => $this->faker->url()
        ];
    }
}
