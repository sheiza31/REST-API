<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['name' => 'Kaos Polos Uniqlo', 'price' => 150000, 'stock' => 50, 'description' => 'Kaos polos berkualitas dari Uniqlo.', 'image' => 'uniqlo_kaos.jpg', 'category_id' => 5],
            ['name' => 'Hoodie Nike', 'price' => 450000, 'stock' => 30, 'description' => 'Hoodie nyaman untuk olahraga dan santai.', 'image' => 'nike_hoodie.jpg', 'category_id' => 6],
            ['name' => 'Jaket Denim Levi\'s', 'price' => 600000, 'stock' => 20, 'description' => 'Jaket denim klasik dari Levi\'s.', 'image' => 'levis_jaket.jpg', 'category_id' => 6],
            ['name' => 'Kaos Oversize H&M', 'price' => 200000, 'stock' => 40, 'description' => 'Kaos oversize trendi dari H&M.', 'image' => 'hm_kaos.jpg', 'category_id' => 5],
            ['name' => 'Celana Chino Zara', 'price' => 350000, 'stock' => 25, 'description' => 'Celana chino elegan dari Zara.', 'image' => 'zara_celana.jpg', 'category_id' => 6],
            ['name' => 'Sweater Adidas', 'price' => 500000, 'stock' => 15, 'description' => 'Sweater stylish dari Adidas.', 'image' => 'adidas_sweater.jpg', 'category_id' => 5],
            ['name' => 'Jaket Kulit Gucci', 'price' => 15000000, 'stock' => 5, 'description' => 'Jaket kulit premium dari Gucci.', 'image' => 'gucci_jaket.jpg', 'category_id' => 6],
            ['name' => 'Kaos Polo Lacoste', 'price' => 400000, 'stock' => 30, 'description' => 'Kaos polo klasik dari Lacoste.', 'image' => 'lacoste_polo.jpg', 'category_id' => 5],
            ['name' => 'Celana Jeans Wrangler', 'price' => 500000, 'stock' => 20, 'description' => 'Celana jeans tahan lama dari Wrangler.', 'image' => 'wrangler_jeans.jpg', 'category_id' => 6],
            ['name' => 'Dress Casual Mango', 'price' => 550000, 'stock' => 18, 'description' => 'Dress casual stylish dari Mango.', 'image' => 'mango_dress.jpg', 'category_id' => 5]
        ];

        DB::table('products')->insert($products);

    }
}
