<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use function App\Helpers\getFactoryDateHelper;

class ProductFactory extends Factory {

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $counter = 1;
        $date = getFactoryDateHelper();

        return [
            //
            'title' => "Title of Product " . $counter,
            'slug' => Str::slug("Title of Product " . $counter, '-'),
            'description' => "Description of Product " . $counter ++ ,
            'small_description' => "Small Description of Course " . $counter ++ ,
            'sku' => $this->faker->numberBetween(0, 9) . $this->faker->randomNumber(7, false),
            'price' => $this->faker->randomFloat($nbMaxDecimals = null, $min = 10, $max = 400),
            'discount' => rand(1, 5) === 5 ? $this->faker->numberBetween(5, 30)  : null,
            'summary' =>"Summary of Product " . $counter ++ ,
            'quantity' => rand(0, 50),
            'publish_at' => rand(0, 1) == 1 ? $date->addYears(rand(1, 2)) : null,
            'cover' => "http://placeimg.com/400/400/any",
            'status' => rand(0, 1),
            'created_at' => $date->format('Y-m-d H:i:s'),
            'updated_at' => $date->addWeeks(rand(1, 12))->subSeconds(rand(36000, 136000))->format('Y-m-d H:i:s'),
        ];
    }

}
