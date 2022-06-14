<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'=> $this->faker->jobTitle(),
            'tags' => 'laravel, api, backend',
            'company'=> $this-> faker-> company(),
            'website'=> $this-> faker-> url(),
            'email'=> $this-> faker-> companyEmail(),
            'location'=> $this-> faker-> city(),
            'description'=> $this-> faker-> paragraph(5),
        ];
    }
}
