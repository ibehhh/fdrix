<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product; // Pastikan Model Product sudah di-import

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hanya ada satu baris 'public function run(): void'
        // Semua data dimasukkan di dalam method ini
        
        Product::create(['name' => 'Spiral DaunJeruk', 'image' => 'https://i.postimg.cc/k40x5HZn/Screenshot-2025-06-09-212014-1.png', 'price' => 'Rp 10K', 'alt' => 'Spiral DaunJeruk snack']);
        Product::create(['name' => 'Keju Aroma', 'image' => 'https://i.postimg.cc/tJpbtfVv/Screenshot-2025-06-09-212014-2.png', 'price' => 'Rp 10K', 'alt' => 'Keju Aroma snack']);
        Product::create(['name' => 'Basreng Pedas', 'image' => 'https://i.postimg.cc/SRvLq2h7/Screenshot-2025-06-09-212014-3.png', 'price' => 'Rp 10K', 'alt' => 'Basreng Pedas snack']);
        Product::create(['name' => 'Dimsum Mentai', 'image' => 'https://i.postimg.cc/W3d9m2xR/Screenshot-2025-06-09-212014-4.png', 'price' => 'Rp 10K', 'alt' => 'Dimsum Mentai snack']);
        Product::create(['name' => 'Ngemil Ngaco', 'image' => 'https://via.placeholder.com/300/f6f6d7/6f8a2f?text=Ngemil+Ngaco', 'price' => 'Rp 10K', 'alt' => 'Ngemil Ngaco snack']);
    }
}