<?php

namespace Database\Seeders;

use App\Models\ProductImages;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductImages::insert([
            [
                'product_id' => '1',
                'image_name' => 'shoes1.png',
            ],
            [
                'product_id' => '2',
                'image_name' => 'shoes2.png',
            ],
            [
                'product_id' => '3',
                'image_name' => 'shoes3.png',
            ],
            [
                'product_id' => '4',
                'image_name' => 'shoes4.png',
            ],
            [
                'product_id' => '5',
                'image_name' => 'shoes5.png',
            ],
            [
                'product_id' => '6',
                'image_name' => 'shoes6.png',
            ],
            [
                'product_id' => '7',
                'image_name' => 'shoes7.png',
            ],
            [
                'product_id' => '8',
                'image_name' => 'shoes8.png',
            ],
            [
                'product_id' => '9',
                'image_name' => 'shoes1.png',
            ],
            [
                'product_id' => '10',
                'image_name' => 'shoes5.png',
            ]
        ]);
    }
}