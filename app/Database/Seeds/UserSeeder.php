<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();
    
        $data = [
            'id' => Uuid::uuid7()->toString(),
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone' => '6281234567890',
            'password' => password_hash('password123', PASSWORD_BCRYPT),
            'profile' => 'https://res.cloudinary.com/beta7x/image/upload/v1720840088/610-6104451_image-placeholder-png-user-profile-placeholder-image-png-removebg-preview_bccniu.png', 
            'role' => 'admin', 
            'is_verif' => 1, 
            'verification_token' => null, 
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $userModel->insert($data);

        echo "User Admin berhasil di-seed.\n";
    }
}
