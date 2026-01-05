<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        //Disable foreign key checks to truncate the table
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        //Truncate the products table before inserting new records
        DB::table('products')->truncate();

        //Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Product::insert([
            [
                'name' => 'Laptop',
                'price' => 999.99,
                'stock_quantity' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Smartphone',
                'price' => 699.99,
                'stock_quantity' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Headphones',
                'price' => 149.99,
                'stock_quantity' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Keyboard',
                'price' => 79.99,
                'stock_quantity' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tablet',
                'price' => 499.99,
                'stock_quantity' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mouse',
                'price' => 29.99,
                'stock_quantity' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Monitor',
                'price' => 249.99,
                'stock_quantity' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bluetooth Speaker',
                'price' => 59.99,
                'stock_quantity' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
