<?php

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
        //$this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'user_' . str_random(2),
            'email' => 'name'.'@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
