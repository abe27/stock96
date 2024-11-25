<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = [
            'name' => 'บาท',
            'description' => 'บาทไทย',
            'symbol' => '฿',
            'is_active' => true,
        ];

        try {
            \App\Models\Currency::create($obj);
        } catch (\Exception $e) {
        }
    }
}
