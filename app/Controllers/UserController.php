<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\UserEntity;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    // Fungsi menampilkan semua user
    public function index()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();

        return view('users/index', $data);
    }

    public function test()
    {
        if(session()->get('role') != 'user') {
            return redirect()->to('/');
        }

        return view('pages/user_dashboard');
    }

    public function merchant()
    {
        return view('pages/merchant_dashboard');
    }

    // Fungsi untuk menampilkan halaman tambah user
    public function create()
    {
        return view('pages/signup');
    }

    // Fungsi untuk menyimpan data user ke Database
    public function store()
    {
        $userModel = new UserModel();
        $user = new UserEntity();

        $user->name = $this->request->getPost('name');
        $user->email = $this->request->getPost('email');
        $user->phone = $this->request->getPost('phone');
        $user->profile = 'https://res.cloudinary.com/beta7x/image/upload/v1720840088/610-6104451_image-placeholder-png-user-profile-placeholder-image-png-removebg-preview_bccniu.png';
        $user->setPassword($this->request->getPost('password'));

        $storeUser = $userModel->insert($user);
        if (!$storeUser) {
            return redirect()->back()->withInput()->with('errors', $userModel->errors());
        }

        return redirect()->to('/')->with('message', 'Pengguna berhasil dibuat');
    }

    // Fungsi untuk menampilkan halaman edit user
    public function edit($id)
    {
        $modelModel = new UserModel();
        $user = $modelModel->find($id);

        // Jika tidak ada user berdasarkan Id maka akan dikembalikan ke halaman semula
        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan');
        }

        return view('users/edit', ['user' => $user]);
    }

    // Fungsi untuk update data user di database
    public function update($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);
        
        if (!$user) {
            return redirect()->back()->with('errors', ['Pengguna tidak ditemukan']);
        }

        $data = $this->request->getPost();
        // Jika password tidak diisi, hapus dari data untuk menghindari penggantian dengan password kosong
        if (empty($data['password'])) {
            unset($data['password']);
        }

        // Assign data ke UserEntity
        $userEntity = new UserEntity($data);

        if (isset($data['password'])) {
            $userEntity->setPassword($data['password']);
        }

        // Validasi dan update
        if (!$userModel->save($userEntity)) {
            return redirect()->back()->withInput()->with('errors', $userModel->errors());
        }

        return redirect()->to('/users')->with('message', 'Pengguna berhasil diperbarui');
    }
}
