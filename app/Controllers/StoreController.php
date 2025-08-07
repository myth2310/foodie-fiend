<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\StoreEntity;
use App\Entities\UserEntity;
use App\Helpers\CloudinaryHelper;
use App\Models\ChartModel;
use App\Models\MenuModel;
use App\Models\ReviewModel;
use App\Models\StoreModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class StoreController extends BaseController
{
    protected $chartModel;
    protected $reviewModel;
    protected $storesModel;

    public function __construct()
    {
        $this->chartModel = new ChartModel();
        $this->reviewModel = new ReviewModel();
        $this->storesModel = new StoreModel();
    }

    // Fungsi untuk menampilkan halaman toko
    public function index()
    {
        $data = [
            'hero_img' => 'https://images.squarespace-cdn.com/content/v1/61709486e77e1d27c181981c/1695741249747-UZPHLNZ0W1P7ZY52V2Y5/0223_UrbanSpace_ZeroIrving_LizClayman_160.png',
        ];

        return view('pages/detail_shop', $data);
    }

    public function getAllStore()
    {
        $storeModel = new StoreModel();
        $stores = $storeModel->select('stores.*, users.name as user_name, users.email')
            ->join('users', 'users.id = stores.user_id')
            ->where('users.is_verif', 2)
            ->where('users.role', 'store')
            ->orderBy('RAND()')
            ->findAll();


        $totalStore = count($stores);


        $data = [
            'stores' => $stores,
            'totalStore' => $totalStore,
        ];

        return $data;
    }



    public function detail($id)
    {

        $storeModel = new StoreModel();
        $menuModel = new MenuModel();
        $user_id = session()->get('user_id');
        $charts = $this->chartModel->getAllChartWithMenu($user_id);


        $store = $storeModel->where('id', $id)->first();

        $dataMenu = $this->reviewModel->getMenusWithRatingFromStoreId($id);
        $menu = $menuModel->getMenusByStore($id);

        if (!$store) {
            session()->setFlashdata('errors', ['Toko tidak ditemukan']);
            return redirect()->to('/');
        }

        return view('pages/store', [
            'menus' => $menu,
            'hero_img' => $store->image_url,
            'charts' => $charts,
            'title' => $store->name,
            'use_hero_text' => false,
        ]);
    }

    public function create()
    {
        $userModel = new UserModel();
        $storeModel = new StoreModel();
        $user = new UserEntity();
        $store = new StoreEntity();

        $db = db_connect();
        $db->transStart();

        try {
            // Ambil data user
            $user->name = $this->request->getPost('name');
            $user->email = $this->request->getPost('email');
            $user->phone = $this->request->getPost('phone');
            $user->role = 'store';
            $password = $this->request->getPost('password');
            $user->profile = 'https://res.cloudinary.com/beta7x/image/upload/v1720840088/610-6104451_image-placeholder-png-user-profile-placeholder-image-png-removebg-preview_bccniu.png';

            // Buat token verifikasi
            $token = bin2hex(random_bytes(32));
            $user->verification_token = $token;
            $user->is_verif = 0;

            $user->setPassword($password);
            $userModel->insert($user);

            $userId = $userModel->getInsertID();

            // Simpan data store
            $store->generateUUID();
            $store->user_id = $userId;
            $store->name = $this->request->getPost('store_name');
            $store->address = $this->request->getPost('address');

            $file = $this->request->getFile('file');
            if ($file->isValid() && !$file->hasMoved()) {
                $filePath = $file->getTempName();
                $uploadHelper = new CloudinaryHelper();
                $uploadResult = $uploadHelper->upload($filePath);
                $store->image_url = $uploadResult['secure_url'];
            }

            $storeModel->save($store);
            $db->transComplete();

            if ($db->transStatus() === false) {
                $userErrors = $userModel->errors();
                $storeErrors = $storeModel->errors();
                $errors = array_merge($userErrors['errors'], $storeErrors['error']);
                session()->setFlashdata('error', 'Terjadi kesalahan dalam penyimpanan data.');
                return redirect()->back()->withInput()->with('errors', $errors);
            }

            // Kirim email verifikasi
            $email = \Config\Services::email();
            $verificationLink = base_url("verification/user/$token");
            $message = "Halo {$user->name},<br><br>Terima kasih telah mendaftar.<br>Silakan klik link di bawah ini untuk verifikasi akun Anda:<br><br>
            <a href='$verificationLink'>Verifikasi Sekarang</a><br><br>Jika Anda tidak merasa membuat akun, abaikan email ini.";

            $email->setTo($user->email);
            $email->setFrom('noreply@domainmu.com', 'RuangInklusi');
            $email->setSubject('Verifikasi Akun');
            $email->setMessage($message);
            $email->send();

            session()->setFlashdata('success', 'Pengguna berhasil dibuat! Silakan cek email untuk verifikasi.');
            return redirect()->to('/');
        } catch (Exception $err) {
            $db->transRollback();
            session()->setFlashdata('error', 'Terjadi kesalahan: ' . $err->getMessage());
            return redirect()->back()->with('errors', $err->getLine());
        }
    }

    public function downloadTemplateSurat()
    {
        $filePath = APPPATH . 'Views/surat_ketersediaan_mitra.pdf';

        if (file_exists($filePath)) {
            return $this->response->download($filePath, null)->setFileName('Template_Surat_Mitra_UMKM.pdf');
        } else {
            session()->setFlashdata('error', 'File template tidak ditemukan.');
            return redirect()->back();
        }
    }

    public function update($id)
    {
        $userModel = new UserModel();
        $storeModel = new StoreModel();
        $user = $userModel->find($id);

        if (!$user) {
            session()->setFlashdata('swal_error', 'User tidak ditemukan.');
            return redirect()->back();
        }

        $store = $storeModel->where('user_id', $id)->first();
        if (!$store) {
            session()->setFlashdata('swal_error', 'Data toko tidak ditemukan.');
            return redirect()->back();
        }

        $db = db_connect();
        $db->transStart();

        try {
            $newName = $this->request->getPost('name');
            $lat = $this->request->getPost('latitude');
            $long = $this->request->getPost('longitude');
            $address = $this->request->getPost('address');

            if ($user->name !== $newName || $user->lat !== $lat || $user->long !== $long || $user->address !== $address) {
                $user->name = $newName;
                $user->lat = $lat;
                $user->long = $long;
                $user->address = $address;
                $userModel->save($user);
            }
            $store->address = $address;
            $file = $this->request->getFile('ktp_url');
            if ($file->isValid() && !$file->hasMoved()) {
                $filePath = $file->getTempName();
                $uploadHelper = new CloudinaryHelper();
                $uploadResult = $uploadHelper->upload($filePath);
                if ($uploadResult) {
                    $store->ktp_url = $uploadResult['secure_url'];
                }
            }

            // $umkm = $this->request->getFile('umkm_letter');
            // if ($umkm->isValid() && !$umkm->hasMoved()) {
            //     $filePath = $umkm->getTempName();
            //     $uploadHelper = new CloudinaryHelper();
            //     $uploadResult = $uploadHelper->upload($filePath);
            //     if ($uploadResult) {
            //         $store->umkm_letter = $uploadResult['secure_url'];
            //     }
            // }

            $signatureBase64 = $this->request->getPost('signature_base64');
            if ($signatureBase64) {
                $data = explode(',', $signatureBase64);
                $decodedData = base64_decode(end($data));

                $tempFile = tempnam(sys_get_temp_dir(), 'sig') . '.png';
                file_put_contents($tempFile, $decodedData);

                $uploadHelper = new CloudinaryHelper();
                $uploadResult = $uploadHelper->upload($tempFile);
                if ($uploadResult) {
                    $store->umkm_letter = $uploadResult['secure_url'];
                }
                unlink($tempFile);
            }

            $storeModel->save($store);

            $db->transComplete();

            if ($db->transStatus() === false) {
                session()->setFlashdata('swal_error', 'Terjadi kesalahan dalam pembaruan data.');
                return redirect()->back()->withInput();
            }

            session()->setFlashdata('swal_success', 'Data pengguna berhasil diperbarui!');
            return redirect()->to('/dashboard');
        } catch (Exception $err) {
            $db->transRollback();
            session()->setFlashdata('swal_error', 'Terjadi kesalahan: ' . $err->getMessage());
            return redirect()->back()->withInput();
        }
    }



    // Fungsi untuk update toko
    // public function update($id)
    // {
    //     $storeModel = new StoreModel();
    //     $store = $storeModel->find($id);

    //     if (!$store) {
    //         return redirect()->back()->with('errors', ['Toko tidak dapat ditemukan']);
    //     }

    //     $data = $this->request->getPost();
    //     $storeEntity = new StoreEntity($data);

    //     if (!$storeModel->update($id, $storeEntity->toArray())) {
    //         return redirect()->back()->withInput()->with('errors', $storeModel->errors());
    //     }

    //     return redirect()->to('/stores')->with('messages', ['Update toko berhasil']);
    // }
}
