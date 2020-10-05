<?php

use Illuminate\Database\Seeder;
use App\Unit;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unit')->insert([
            'id'   => 1,
            'name' => 'Acre',
            'sign_date' => date('y-m-d h:m:s'),
        ]);
        DB::table('unit')->insert([
            'name' => 'Ampere',
            'sign_date' => date('y-m-d h:m:s'),
        ]);
        DB::table('unit')->insert([
            'name' => 'Bag',
            'sign_date' => date('y-m-d h:m:s'),
        ]);
        DB::table('unit')->insert([
            'name' => 'Barrel',
            'sign_date' => date('y-m-d h:m:s'),
        ]);
        DB::table('unit')->insert([
            'name' => 'Blade',
            'sign_date' => date('y-m-d h:m:s'),
        ]);
        DB::table('unit')->insert([
            'name' => 'Box',
            'sign_date' => date('y-m-d h:m:s'),
        ]);
        DB::table('unit')->insert([
            'name' => 'Bushel',
            'sign_date' => date('y-m-d h:m:s'),
        ]);
        DB::table('unit')->insert([
            'name' => 'Carton',
            'sign_date' => date('y-m-d h:m:s'),
        ]);
        DB::table('unit')->insert([
            'name' => 'Case',
            'sign_date' => date('y-m-d h:m:s'),
        ]);
    }
}
