<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::flushEventListeners();

        factory(User::class, 1)->create(['name' => 'Héctor', 'email' => 'prueba@test.com', 'password' => bcrypt(123)]);
        factory(User::class, 20)->create();
    }
}
