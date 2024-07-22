<?php

namespace App\Database\Seeds;

use App\Models\CategoryModel;
use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categoryModel = new CategoryModel();
        // Buat data seeder
        $data = [
            [
                'name' => 'Berkuah',
                'description' => 'Kategori untuk semua makanan yang memiliku kuah',
            ],
            [
                'name' => 'Tidak Berkuah',
                'description' => 'Kategori untuk semua makanan yang tidak memiliki kuah',
            ],
            [
                'name' => 'Sate',
                'description' => 'Kategori untuk semua jenis makanan Sate',
            ],
            [
                'name' => 'Bakso',
                'description' => 'Kategori untuk semua jenis makanan Bakso',
            ],
            [
                'name' => 'Nasi Goreng',
                'description' => 'Kategori untuk semua jenis makanan Nasi Goreng',
            ],
            [
                'name' => 'Sayur',
                'description' => 'Kategori untuk semua jenis Sayur',
            ],
            [
                'name' => 'Gulai',
                'description' => 'Kategori untuk semua jenis makanan Gulai',
            ],
            [
                'name' => 'Pecel',
                'description' => 'Kategori untuk semua jenis makanan Pecel',
            ],
            [
                'name' => 'Gorengan',
                'description' => 'Kategori untuk semua jenis makanan Goreng-gorengan',
            ],
            [
                'name' => 'Lainnya',
                'description' => 'Kategori untuk semua makanan yang lain',
            ],
        ];

        // Menggunakan query builder untuk memasukkan data
        // $this->db->table('categories')->insertBatch($data);

        // Menggunakan model untuk memasukkan data
        $categoryModel->insertBatch($data);
    }
}
