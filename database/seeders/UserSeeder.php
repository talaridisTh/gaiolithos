<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'first_name' => 'admin',
            'last_name' =>'admin',
            'name' => 'admin',
            'email' => "admin@gmail.com",
            'phone' => 6946989698,
            'description' => "Description of User ",
            'avatar' => "/images/avatar-placeholder.png",
            "slug" => 'admin',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'status' => 1,
        ])->assignRole("admin");


        User::factory()->times(20)->create();
    }
}
