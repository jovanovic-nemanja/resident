<?php

use Illuminate\Database\Seeder;
use App\Models\Users;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Users::create([
			'id'   => 1,
	        'name' => 'Admin',
	        'email' => 'admin@gmail.com',
            'email_verified_at' => 1,
            'password' => '$2y$10$43Lgdx7qDxGdj3cDyfcw4uLj5nVQ6vsQ3obexrb/axByYf4B6roZO', // secret
            'gender' => 0,
            'birthday' => '1999-10-29',
            'address' => 'Serbia Beograd',
            'role_id' => 1,
            'remember_token' => Str::random(10),
            'sign_date' => date('y-m-d h:m:s'),
		]);
    }
}
