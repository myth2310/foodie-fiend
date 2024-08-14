<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UserEntity extends Entity
{
    protected $attributes = [
        'name' => null,
        'phone' => null,
        'email' => null,
        'password' => null,
        'verification_token' => null,
    ];
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    // Setter untuk password yang akan dihash
    public function setPassword(string $password)
    {
        // // Validasi panjang password
        // if (strlen($password) < 8) {
        //     $this->errors['password'] = "Kata sandi harus terdiri dari minimal 8 karakter.";
        //     return false; // 
        // }

        // // Validasi keberadaan karakter huruf besar, huruf kecil, dan angka
        // if (!preg_match('/[A-Z]/', $password)) {
        //     $this->errors['password'] = "Kata sandi harus terdiri dari setidaknya satu huruf besar.";
        //     return false;
        // }

        // if (!preg_match('/[a-z]/', $password)) {
        //     $this->errors['password'] = "Kata sandi harus terdiri dari setidaknya satu huruf kecil.";
        //     return false;
        // }

        // if (!preg_match('/[0-9]/', $password)) {
        //     $this->errors['password'] = "Kata sandi harus terdiri dari setidaknya satu digit angka.";
        //     return false;
        // }

        // // Validasi keberadaan karakter khusus (opsional)
        // if (!preg_match('/[\W]/', $password)) {
        //     $this->errors['password'] = "Kata sandi harus mengandung setidaknya satu karakter khusus.";
        //     return false;
        // }

        // Jika validasi berhasil, hash password sebelum menyimpannya
        $this->attributes['password'] = password_hash($password, PASSWORD_DEFAULT);
        return $this;

        // return true; // Validasi berhasil
    }

    // Getter untuk mendapatkan email dalam format lowercase
    public function getFormatterEmail()
    {
        return strtolower($this->attributes['email']);
    }
}
