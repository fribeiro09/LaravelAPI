<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Fernando Ribeiro',
            'email' => 'fernandoliveira6@hotmail.com',
            'password' => Hash::make('123')
        ]);
    }
}
