<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = [
            [
                'name' => 'เอฟ',
                'address_1' => '121',
                'vat' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'เอ๋',
                'address_1' => '154',
                'vat' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'จูน',
                'address_1' => '120',
                'vat' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'เกว',
                'address_1' => '146',
                'vat' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'พล',
                'address_1' => '146',
                'vat' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'อั๋น',
                'address_1' => 'โรงงานเกว',
                'vat' => 5,
                'is_active' => true,
            ]
        ];

        foreach ($obj as $data) {
            try {
                $colors = ['info', 'success', 'primary', 'danger', 'warning'];
                $item['color'] = $colors[rand(0, count($colors) - 1)];
                \App\Models\Customer::create($data);
            } catch (\Exception $ex) {
            }
        }
    }
}
