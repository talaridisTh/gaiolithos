<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use function App\Helpers\getFactoryDateHelper;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $counter = 1;
        $date = getFactoryDateHelper();
        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;


        return [
            'first_name' => $firstName,
            'last_name' =>$lastName,
            'name' => $firstName."-".$lastName,
            'email' => $firstName.".".$lastName."@example.com",
            'phone' => 69 . $this->faker->numberBetween(3, 9) . $this->faker->randomNumber(7, false),
            'profile' => "Description of User " . $counter ++ ,
            'avatar' => "/images/avatar-placeholder.png",
            "slug" => Str::slug($firstName."-".$lastName, '-'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'status' => $this->faker->numberBetween(0, 1),
            'remember_token' => Str::random(10),
            'created_at' => $date->format('Y-m-d H:i:s'),
            'email_verified_at' => rand(1, 4) === 4 ? null : $date->addMinutes(rand(5, 180))->format('Y-m-d H:i:s'),
            'updated_at' => $date->addWeeks(rand(1, 12))->subSeconds(rand(36000, 136000))->format('Y-m-d H:i:s')
        ];
    }
}
