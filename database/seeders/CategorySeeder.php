<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = [
            [
                'name' => 'เครื่องดื่ม',
                'description' => '-',
                'is_active' => true,
            ],
            [
                'name' => 'บุหรี่',
                'description' => '-',
                'is_active' => true,
            ],
            [
                'name' => 'ของใช้ในครัว',
                'description' => '-',
                'is_active' => true,
            ],
            [
                'name' => 'ขนม',
                'description' => '-',
                'is_active' => true,
            ],
            [
                'name' => 'อาหาร',
                'description' => '-',
                'is_active' => true,
            ],
            [
                'name' => 'ของใช้ส่วนตัว',
                'description' => '-',
                'is_active' => true,
            ],
            [
                'name' => 'ของใช้ในบ้าน',
                'description' => '-',
                'is_active' => true,
            ],
            [
                'name' => 'ของชําร่วย',
                'description' => '-',
                'is_active' => true,
            ],
            [
                'name' => 'อัน',
                'description' => '-',
                'is_active' => true,
            ],
        ];

        foreach ($obj as $item) {
            try {
                \App\Models\Category::create($item);
            } catch (\Exception $e) {
            }
        }
    }
}
