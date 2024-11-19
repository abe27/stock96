<?php

namespace Database\Seeders;

use App\Models\Currency;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class StoreNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $storeNames = [
            [
                'currency_id' => 'บาท',
                'name' => 'ร้านค้าบ้าน96',
                'description' => 'เครื่องดื่มเหล้าเบียร์.เครื่องปรุงของแห้ง ขนมขบเคี้ยว',
                'address_1' => '123 Main St',
                'address_2' => 'Apt 123',
                'phone_number' => '123-456-7890',
                'email' => 'example@store.com',
                'website' => 'https://examplestore.com',
                'logo' => 'example_store_logo.png',
                'is_active' => true,
            ],
            // Add more store names as needed...
        ];

        try {
            foreach ($storeNames as $storeName) {
                $currency = Currency::where('name', $storeName['currency_id'])->first();
                $storeName['currency_id'] = $currency->id;
                \App\Models\StoreName::create($storeName);
            }
        } catch (\Exception $ex) {
            Log::error($ex);
        }
    }
}
