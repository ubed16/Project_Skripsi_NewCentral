<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'product_code' => 'A1',
                'size' => '1000x100',
                'type' => 'standart',
                'price' => '10000',
            ],
            [
                'product_code' => 'A2',
                'size' => '2000x200',
                'type' => 'standart',
                'price' => '2000',
            ],
        ];

        Item::insert($data);
    }
}
