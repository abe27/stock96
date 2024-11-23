<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = [
            [
                'name' => 'ร้านต้นกิ๊ก',
                'address_1' => 'ข้างหมู่ย้าน',
                'mobile_bo' => '-',
                'vat' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'ร้านขายส่งแปลงยาว',
                'address_1' => 'อยู่หน้าปากซอย',
                'mobile_bo' => '-',
                'vat' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'แมคโค',
                'address_1' => '-',
                'mobile_bo' => '-',
                'vat' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'โลตัส',
                'address_1' => '-',
                'mobile_bo' => '-',
                'vat' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'รถส่งน้ำแข็ง',
                'address_1' => 'มาส่งที่บ้าน',
                'mobile_bo' => '-',
                'vat' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'ร้านค้าปลีกทั่วไป',
                'address_1' => '-',
                'mobile_bo' => '-',
                'vat' => 0,
                'is_active' => true,
            ]
        ];

        foreach ($obj as $item) {
            try {
                $colors = ['info', 'success', 'primary', 'danger', 'warning'];
                $item['color'] = $colors[rand(0, count($colors) - 1)];
                \App\Models\Supplier::create($item);
            } catch (\Exception $e) {
            }
        }
    }
}
