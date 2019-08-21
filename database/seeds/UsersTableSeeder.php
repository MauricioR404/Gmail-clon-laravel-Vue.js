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
        User::create([
            'name' => 'Mauricio',
            'email' => 'mauricio@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}
