<?php

use Illuminate\Database\Seeder;
use App\Tabs;

class TabsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tabs::create([
            'id' => 1,
            'name' => 'Health Base Line',
            'sign_date' => date('Y-m-d H:i:s'),
        ]);
        Tabs::create([
            'id' => 2,
            'name' => 'Allergies and Diet',
            'sign_date' => date('Y-m-d H:i:s'),
        ]);
        Tabs::create([
            'id' => 3,
            'name' => 'Advance Directive',
            'sign_date' => date('Y-m-d H:i:s'),
        ]);
    }
}
