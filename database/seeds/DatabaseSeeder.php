<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name' => 'Héctor', 'email' => 'prueba@test.com', 'password' => bcrypt('123')]);
        // $this->call(UsersTableSeeder::class);
    }
}
