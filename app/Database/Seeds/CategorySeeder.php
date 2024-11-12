<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Ramsey\Uuid\Uuid;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => Uuid::uuid7()->toString(),
                'name'        => 'Makanan Ringan',
                'description' => 'Camilan ringan yang mudah dikonsumsi.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
                'deleted_at'  => null,
            ],
            [
                'id'          => '2b3c4d5e-6f7g-8h9i-0j1k-2l3m4n5o6p7q',
                'name'        => 'Makanan Berat',
                'description' => 'Makanan utama yang mengenyangkan, seperti nasi dan lauk-pauk.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
                'deleted_at'  => null,
            ],
            [
                'id' => Uuid::uuid7()->toString(),
                'name'        => 'Minuman',
                'description' => 'Berbagai jenis minuman, baik yang panas maupun dingin.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
                'deleted_at'  => null,
            ],
            [
                'id' => Uuid::uuid7()->toString(),
                'name'        => 'Kue & Roti',
                'description' => 'Kue dan roti, baik untuk camilan maupun hidangan penutup.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
                'deleted_at'  => null,
            ],
            [
                'id' => Uuid::uuid7()->toString(),
                'name'        => 'Makanan Tradisional',
                'description' => 'Makanan khas daerah atau tradisional Indonesia.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
                'deleted_at'  => null,
            ],
            [
                'id' => Uuid::uuid7()->toString(),
                'name'        => 'Makanan Organik',
                'description' => 'Makanan yang terbuat dari bahan organik tanpa bahan pengawet.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
                'deleted_at'  => null,
            ],
            [
                'id' => Uuid::uuid7()->toString(),
                'name'        => 'Makanan Beku',
                'description' => 'Makanan yang dibekukan untuk daya tahan lebih lama, seperti bakso atau nugget.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
                'deleted_at'  => null,
            ],
            [
                'id' => Uuid::uuid7()->toString(),
                'name'        => 'Makanan Sehat',
                'description' => 'Makanan yang rendah kalori, rendah lemak, dan kaya nutrisi.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
                'deleted_at'  => null,
            ],
            [
                'id' => Uuid::uuid7()->toString(),
                'name'        => 'Makanan Olahan',
                'description' => 'Makanan yang diproses seperti abon, rendang, dan dendeng.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
                'deleted_at'  => null,
            ],
            [
                'id' => Uuid::uuid7()->toString(),
                'name'        => 'Bumbu & Rempah',
                'description' => 'Berbagai bumbu dan rempah kemasan seperti sambal, kecap, dan bubuk rempah.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
                'deleted_at'  => null,
            ]
        ];

        $this->db->table('categories')->insertBatch($data);
    }
}
