<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Soya Original',
                'description' => 'Soya original (atau susu kedelai original) adalah minuman nabati yang terbuat dari sari kacang kedelai murni, biasanya melalui proses perendaman, penggilingan, perebusan, dan penyaringan.', 
                'price' => '7000',
                'category' => 'minuman',
                'size' => '250 ML',
                'stock' => '20'
            ],
            [
                'name' => 'Soya Greentea',
                'description' => 'Soya green tea adalah minuman kombinasi teh hijau yang kaya antioksidan (katekin/EGCG) dengan susu kedelai (soya) sebagai sumber protein nabati.', 
                'price' => '10000',
                'category' => 'minuman',
                'size' => '250 ML',
                'stock' => '20'
            ],
            [
                'name' => 'Soya Greentea',
                'description' => 'Soya Coklat adalah minuman kombinasi coklat yang kaya antioksidan (katekin/EGCG) dengan susu kedelai (soya) sebagai sumber protein nabati.', 
                'price' => '12000',
                'category' => 'minuman',
                'size' => '250 ML',
                'stock' => '20'
            ],
            [
                'name' => 'Soya Original 1L',
                'description' => 'Soya original (atau susu kedelai original) adalah minuman nabati yang terbuat dari sari kacang kedelai murni, biasanya melalui proses perendaman, penggilingan, perebusan, dan penyaringan.', 
                'price' => '18000',
                'category' => 'minuman',
                'size' => '1500 ML',
                'stock' => '20'
            ],
            [
                'name' => 'Kembang Tahu Original',
                'description' => 'Kembang tahu original (atau susu kedelai original) adalah makanan nabati yang terbuat dari sari kacang kedelai murni, biasanya melalui proses perendaman, penggilingan, perebusan, dan penyaringan.', 
                'price' => '7000',
                'category' => 'makanan',
                'size' => '1 porsi',
                'stock' => '20'
            ],
            [
                'name' => 'Kembang Tahu Brown Sugar',
                'description' => 'Kembang tahu dengan gula merah (atau susu kedelai original) adalah makanan nabati yang terbuat dari sari kacang kedelai murni, biasanya melalui proses perendaman, penggilingan, perebusan, dan penyaringan.', 
                'price' => '7000',
                'category' => 'makanan',
                'size' => '1 porsi',
                'stock' => '20'
            ]
        ];

        foreach($products as $product){
            Product::create($product);
        }
    }
}
