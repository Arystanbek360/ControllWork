<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productNames = [
            'Apple iPhone 11',
            'Apple Airpods 3',
            'Samsung Galaxy S21',
            'Sony PlayStation 5',
            'Dell XPS 13',
            'Nike Air Max',
            'Adidas UltraBoost',
            'Bose QuietComfort 35',
            'Canon EOS R5',
            'GoPro HERO9 Black',
            'Microsoft Surface Pro 7',
            'Nikon D850',
            'Panasonic Lumix GH5',
            'Samsung Galaxy Watch 3',
            'Xiaomi Mi 11',
            'Huawei P40 Pro',
            'Oppo Find X3 Pro',
            'Lenovo ThinkPad X1 Carbon',
            'Asus ROG Zephyrus G14',
            'Apple MacBook Air',
            'Samsung Galaxy Tab S7',
            'Amazon Echo Dot',
            'Google Nest Hub',
            'JBL Flip 5',
            'Logitech MX Master 3',
            'Fitbit Charge 4',
            'Garmin Fenix 6',
            'Dyson V11 Absolute',
            'Roomba i7+',
            'Philips Hue Lightbulbs',
            'Sony WH-1000XM4',
            'Marshall Emberton',
            'Beats Powerbeats Pro',
            'Braun Series 9 Shaver',
            'Nespresso Vertuo Next',
            'KitchenAid Stand Mixer',
            'Breville Barista Express',
            'Sonos Move',
            'Razer DeathAdder V2',
            'Corsair K95 RGB Platinum'
        ];

        foreach ($productNames as $productName) {
            Item::create([
                'name' => $productName,
                'amount' => rand(1, 10) * 100
            ]);
        }
    }
}
