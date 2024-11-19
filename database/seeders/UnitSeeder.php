<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = [
            [
                'name' => 'ขวด',
                'description' => '-',
                'conversion_rate' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'แบน',
                'description' => '-',
                'conversion_rate' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'กลม',
                'description' => '-',
                'conversion_rate' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'ลัง',
                'description' => '-',
                'conversion_rate' => 12,
                'is_active' => true,
            ],
            [
                'name' => 'แผง',
                'description' => '-',
                'conversion_rate' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'ถุง',
                'description' => '-',
                'conversion_rate' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'ใบ',
                'description' => '-',
                'conversion_rate' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'ลูก',
                'description' => '-',
                'conversion_rate' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'ซอง',
                'description' => '-',
                'conversion_rate' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'กระป๋อง',
                'description' => '-',
                'conversion_rate' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'กระปุก',
                'description' => '-',
                'conversion_rate' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'ห่อ',
                'description' => '-',
                'conversion_rate' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'กระสอบ',
                'description' => '-',
                'conversion_rate' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'กล่อง',
                'description' => '-',
                'conversion_rate' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'ก้อน',
                'description' => '-',
                'conversion_rate' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'หลอด',
                'description' => '-',
                'conversion_rate' => 1,
                'is_active' => true,
            ]
        ];

        foreach ($obj as $item) {
            try {
                \App\Models\Unit::create($item);
            } catch (\Exception $e) {
            }
        }
    }
}
