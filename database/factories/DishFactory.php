<?php

namespace Database\Factories;

use FakerRestaurant\Provider\en_US\Restaurant as FakerRestaurant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Xvladqt\Faker\LoremFlickrProvider;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dish>
 */
class DishFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new FakerRestaurant($this->faker));
        $this->faker->addProvider(new LoremFlickrProvider($this->faker));  // <- Ici

        $images = [
            'https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=480&w=640',
            'https://images.pexels.com/photos/70497/pexels-photo-70497.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=480&w=640',
            'https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=480&w=640',
            'https://images.pexels.com/photos/2232/vegetables-italian-pizza-restaurant.jpg?auto=compress&cs=tinysrgb&dpr=2&h=480&w=640',
            'https://images.pexels.com/photos/3731422/pexels-photo-3731422.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=480&w=640',
            'https://images.pexels.com/photos/4809158/pexels-photo-4809158.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=480&w=640',
            'https://images.pexels.com/photos/3709845/pexels-photo-3709845.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=480&w=640',
            'https://images.pexels.com/photos/3654594/pexels-photo-3654594.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=480&w=640',
            'https://images.pexels.com/photos/414645/pexels-photo-414645.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=480&w=640',
            'https://images.pexels.com/photos/70497/pexels-photo-70497.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=480&w=640',
            'https://images.pexels.com/photos/1099680/pexels-photo-1099680.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=480&w=640',
            'https://images.pexels.com/photos/461198/pexels-photo-461198.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=480&w=640',

        ];

        return [
            'name' => $this->faker->foodName(),
            'image' => $this->faker->randomElement($images),
            'description' => $this->faker->text(),
        ];
    }
}
