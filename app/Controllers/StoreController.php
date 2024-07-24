<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\StoreEntity;
use App\Entities\UserEntity;
use App\Helpers\CloudinaryHelper;
use App\Models\StoreModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class StoreController extends BaseController
{
    // Fungsi untuk menampilkan halaman toko
    public function index()
    {
        $data = ['hero_img' => 'https://images.squarespace-cdn.com/content/v1/61709486e77e1d27c181981c/1695741249747-UZPHLNZ0W1P7ZY52V2Y5/0223_UrbanSpace_ZeroIrving_LizClayman_160.png'];
        return view('pages/detail_shop', $data);
    }

    public function getAllStore()
    {
        $storeModel = new StoreModel();
        $stores = $storeModel->findAll();
        $totalStore = count($stores);
        $data = [
            'stores' => $stores,
            'totalStore' => $totalStore, 
        ];

        return $data;
    }

    // Fungsi untuk menampilkan detail toko
    public function detail($id)
    {
        $storeModel = new StoreModel();
        $menuController = new MenuController();
        $categoryController = new CategoryController();

        $store = $storeModel->find($id);
        $dataMenu = $menuController->getAll($id);
        $categories = $categoryController->get($id);

        if (!$store) {
            session()->setFlashdata('errors', ['Toko tidak ditemukan']);
            return redirect()->to('/');
        }

        return view('pages/store', [
            'menus' => $dataMenu,
            'categories' => $categories,
            'hero_img' => $store->image_url,
            'use_hero_text' => false,
        ]);
    }

    // Fungsi untuk buat toko baru
    public function create()
    {
        $userModel = new UserModel();
        $storeModel = new StoreModel();
        $user = new UserEntity();
        $store = new StoreEntity();

        $db = db_connect();
        $db->transStart();

        try {
            // Insert data into users table
            $user->name = $this->request->getPost('name');
            $user->email = $this->request->getPost('email');
            $user->phone = $this->request->getPost('phone');
            $user->role = $this->request->getPost('role');
            $user->role = 'store';
            $password = $this->request->getPost('password');
            $user->profile = 'https://res.cloudinary.com/beta7x/image/upload/v1720840088/610-6104451_image-placeholder-png-user-profile-placeholder-image-png-removebg-preview_bccniu.png';

            $user->setPassword($password);
            $userModel->insert($user);

            $userId = $userModel->getInsertID();
            $store->generateUUID();
            $store->user_id = $userId;
            $store->name = $this->request->getPost('store_name');
            $store->address = $this->request->getPost('store_address');
            
            $file = $this->request->getFile('file');
            if ($file->isValid() && !$file->hasMoved()) {
                // Path sementara file
                $filePath = $file->getTempName();

                // Upload file ke Cloudinary
                $uploadHelper = new CloudinaryHelper();
                $uploadResult = $uploadHelper->upload($filePath);

                // Mendapatkan URL file yang diupload
                $store->image_url = $uploadResult['secure_url'];
            }

            $storeModel->save($store);

            $db->transComplete();

            if ($db->transStatus() === false) {
                $userErrors = $userModel->errors();
                $storeErrors = $storeModel->errors();
                $errors = array_merge($userErrors['errors'], $storeErrors['error']);

                return redirect()->back()->withInput()->with('errors', $errors);
            }
            return redirect()->to('/dashboard')->with('messages', ['Pengguna berhasil dibuat']);
            
        } catch (Exception $err) {
            $db->transRollback();
            return redirect()->back()->with('errors', $err->getLine());
        }
    }

    // Fungsi untuk update toko
    public function update($id)
    {
        $storeModel = new StoreModel();
        $store = $storeModel->find($id);
        
        if (!$store) {
            return redirect()->back()->with('errors', ['Toko tidak dapat ditemukan']);
        }
        
        $data = $this->request->getPost();
        $storeEntity = new StoreEntity($data);

        if (!$storeModel->update($id, $storeEntity->toArray())) {
            return redirect()->back()->withInput()->with('errors', $storeModel->errors());
        }

        return redirect()->to('/stores')->with('messages', ['Update toko berhasil']);
    }
}
