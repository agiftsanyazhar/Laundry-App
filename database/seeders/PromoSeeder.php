<?php

namespace Database\Seeders;

use App\Models\Promo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promos = [
            [
                'image' => 'uploads/promo-images/luxury grey.jpg',
                'shop_id' => 5,
                'old_price' => 19000,
                'new_price' => 15000,
                'description' => 'Promo Flash Sales Idul Fitri',
            ],
            [
                'image' => 'uploads/promo-images/undercover set.jpg',
                'shop_id' => 9,
                'old_price' => 19000,
                'new_price' => 15000,
                'description' => 'Promo Flash Sales Idul Fitri',
            ],
        ];

        foreach ($promos as $promo) {
            Promo::create($promo);
        }
    }
}
