<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\RoleUser;

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
			'id'   => 1,
	        'firstname' => 'Admin',
            'middlename' => 'Admin',
            'lastname' => 'Admin',
            'username' => 'admin',
	        'email' => 'admin@gmail.com',
            'email_verified_at' => 1,
            'clinic_id' => '',
            'profile_logo' => '1.png',
            'password' => '$2y$10$ZeqKgYJ27cNPn6.ah6ZQZOkvf6aN3v.picv3D12FGJnjfDAyJz3Va', // bluecarehub1029
            'phone_number' => '029292162',
            'gender' => 0,
            'birthday' => '1999-10-29',
            'street1' => 'Serbia',
            'street2' => 'Beograd',
            'city' => 'Beograd',
            'zip_code' => '11042',
            'state' => 'Beograd',
            'remember_token' => str_random(10),
            'sign_date' => date('y-m-d h:m:s'),
		]);

        Role::create([
            'id' => 1,
            'name' => 'admin' 
        ]);
        Role::create([
            'id' => 2,
            'name' => 'care taker' 
        ]);
        Role::create([
            'id' => 3,
            'name' => 'resident' 
        ]);
        Role::create([
            'id' => 4,
            'name' => 'clinicowner' 
        ]);

        RoleUser::create([
            'id' => 1,
            'user_id' => 1,
            'role_id' => 1,
        ]);
    }
}
