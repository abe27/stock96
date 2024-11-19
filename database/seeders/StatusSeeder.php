<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = [
            [
                'name' => 'จ่ายสด',
                'description' => '-',
                'color' => 'success',
                'is_active' => true,
            ],
            [
                'name' => 'ยังไม่จ่าย',
                'description' => '-',
                'color' => 'danger',
                'is_active' => true,
            ],
            [
                'name' => 'เครดิต 15 วัน',
                'description' => '-',
                'color' => 'info',
                'is_active' => true,
            ],
            [
                'name' => 'เครดิต 30 วัน',
                'description' => '-',
                'color' => 'primary',
                'is_active' => true,
            ],
            [
                'name' => 'ยกเลิก',
                'description' => '-',
                'color' => 'info',
                'is_active' => true,
            ]
        ];

        foreach ($obj as $item) {
            try {
                \App\Models\Status::create($item);
            } catch (\Exception $ex) {
            }
        }
    }
}
