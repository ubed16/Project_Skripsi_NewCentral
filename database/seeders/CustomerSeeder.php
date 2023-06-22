<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
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
                'name' => 'SKA',
                'email' => 'ska@gmail.com',
                'company' => 'SKA',
                'address' => 'JL Miko',
                'phone' => '08222222222'
            ],
            [
                'name' => 'RCK',
                'email' => 'rck@gmail.com',
                'company' => 'RCK',
                'address' => 'JL Raya Kletek',
                'phone' => '0833333333'
            ]
            ];

        Customer::insert($data);
    }
}
