<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronik'],
            ['name' => 'Fashion Pria'],
            ['name' => 'Fashion Wanita'],
            ['name' => 'Kesehatan & Kecantikan'],
            ['name' => 'Peralatan Rumah Tangga'],
            ['name' => 'Olahraga & Outdoor'],
            ['name' => 'Buku & Alat Tulis'],
            ['name' => 'Mainan & Hobi'],
            ['name' => 'Makanan & Minuman'],
            ['name' => 'Handphone & Aksesoris'],
            ['name' => 'Komputer & Laptop'],
            ['name' => 'Otomotif'],
            ['name' => 'Film & Musik'],
            ['name' => 'Produk Digital'],
            ['name' => 'Gaming'],
            ['name' => 'Perhiasan & Aksesoris'],
            ['name' => 'Ibu & Bayi'],
            ['name' => 'Pet Shop'],
            ['name' => 'Peralatan Dapur'],
            ['name' => 'Travel & Lifestyle'],
        ];

        DB::table('categories')->insert($categories);
    }
}
