<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use function App\Helpers\getFactoryDateHelper;

class CategoryFactory extends Factory {

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

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
            'title' => "Title of Category " . $counter,
            'slug' => Str::slug("Title of Category " . $counter, '-'),
            "parent_id" =>null,
            'description' => "Description of Category " . $counter ++,
            'cover' => "http://placeimg.com/400/400/any",
            "status" => rand(0, 1),
            'created_at' => $date->format('Y-m-d H:i:s'),
            'updated_at' => $date->addWeeks(rand(1, 12))->subSeconds(rand(36000, 136000))->format('Y-m-d H:i:s'),
        ];
    }

}
