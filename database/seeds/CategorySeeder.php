<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'id'   => 1,
            'name' => 'Smartwatch',
            'slug' => 'smartwatch',
            'sign_date' => date('y-m-d h:m:s'),
        ]);

        Category::create([
            'id'   => 2,
            'name' => 'Smartphone',
            'slug' => 'smartphone',
            'sign_date' => date('y-m-d h:m:s'),
        ]);

        Category::create([
            'id'   => 3,
            'name' => 'Smart TV',
            'slug' => 'smart-tv',
            'sign_date' => date('y-m-d h:m:s'),
        ]);

        Category::create([
            'id'   => 4,
            'name' => 'Iphone',
            'slug' => 'iphone',
            'sign_date' => date('y-m-d h:m:s'),
        ]);

        Category::create([
            'id'   => 5,
            'name' => 'Laptop',
            'slug' => 'laptop',
            'sign_date' => date('y-m-d h:m:s'),
        ]);

        Category::create([
            'id'   => 6,
            'name' => 'Food',
            'slug' => 'food',
            'sign_date' => date('y-m-d h:m:s'),
        ]);

        Category::create([
            'id'   => 7,
            'name' => 'Hospitality',
            'slug' => 'hospitality',
            'sign_date' => date('y-m-d h:m:s'),
        ]);

        Category::create([
            'id'   => 8,
            'name' => 'Auto',
            'slug' => 'auto',
            'sign_date' => date('y-m-d h:m:s'),
        ]);

        Category::create([
            'id'   => 9,
            'name' => 'Petrochemical',
            'slug' => 'petrochemical',
            'sign_date' => date('y-m-d h:m:s'),
        ]);

        Category::create([
            'id'   => 10,
            'name' => 'Medical',
            'slug' => 'medical',
            'sign_date' => date('y-m-d h:m:s'),
        ]);
    }
}
