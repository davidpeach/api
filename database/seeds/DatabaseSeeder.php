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
        factory(User::class)->create([
        	'name' => env('ADMIN_NAME'),
        	'email' => env('ADMIN_EMAIL'),
        	'password' => bcrypt(env('ADMIN_PASSWORD')),
        ]);
    }
}
