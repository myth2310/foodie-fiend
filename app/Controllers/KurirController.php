<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Entities\UserEntity;
use App\Models\UserModel;
use App\Models\KurirModel;
use App\Models\OrderModel;
use App\Helpers\CloudinaryHelper;

class KurirController extends BaseController
{

    protected $user;
    protected $userModel;
    protected $kurirModel;
    protected $orderModel;
    protected $uploadHelper;

    public function __construct()
    {
        $this->user = new UserEntity();
        $this->userModel = new UserModel();
        $this->kurirModel = new KurirModel();
        $this->orderModel = new OrderModel();
        $this->uploadHelper = new CloudinaryHelper();
    }

    public function index()
    {
        $session = session();
        $userId = $session->get('user_id');

        $db = \Config\Database::connect();

        $kurir = $db->table('kurirs')
            ->select('affiliate_id')
            ->where('user_id', $userId)
            ->get()
            ->getRowArray();

        $umkmName = null;
        $umkmLat = null;
        $umkmLong = null;

        if ($kurir && !empty($kurir['affiliate_id'])) {
            $store = $db->table('users')
                ->select('users.name AS user_name, stores.name AS umkm_name, users.lat, users.long')
                ->join('stores', 'stores.user_id = users.id')
                ->where('users.id', $kurir['affiliate_id'])
                ->get()
                ->getRowArray();

            if ($store) {
                $umkmName = $store['umkm_name'];
                $umkmLat = $store['lat'];
                $umkmLong = $store['long'];
            }
        }


        $orders = $db->table('orders')
            ->select('
                orders.*,
                menus.name AS menu_name,
                users.name AS customer_name,
                users.lat AS customer_latitude,
                users.long AS customer_longitude
            ')
            ->join('menus', 'menus.id = orders.menu_id')
            ->join('users', 'users.id = orders.user_id')
            ->where('orders.kurir_id', $userId)
            ->orderBy('orders.created_at', 'DESC')
            ->get()
            ->getResultArray();


        return view('kurir/dashboard', [
            'umkm' => $umkmName,
            'umkm_lat' => $umkmLat,
            'umkm_long' => $umkmLong,
            'username' => $session->get('name'),
            'orders' => $orders,
        ]);
    }

    public function delete($id)
{
    try {
        $userModel = new UserModel();

        $user = $userModel->find($id);
        if (!$user) {
            session()->setFlashdata('error', 'Data kurir tidak ditemukan.');
            return redirect()->to('/dashboard/kurir');
        }

        // Tidak perlu menghapus kurirs secara manual
        $userModel->delete($id);

        session()->setFlashdata('success', 'Data kurir berhasil dihapus.');
    } catch (\Exception $e) {
        session()->setFlashdata('error', 'Terjadi kesalahan menghapus data: ' . $e->getMessage());
    }

    return redirect()->to('/dashboard/kurir');
}



    public function store()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $password = $this->request->getPost('password');
        $status = $this->request->getPost('status');

        $affiliateId = session()->get('user_id');

        if ($this->userModel->where('email', $email)->first()) {
            session()->setFlashdata('error', 'Email sudah terdaftar. Silakan gunakan email lain.');
            return redirect()->back()->withInput();
        }

        if ($this->userModel->where('phone', $phone)->first()) {
            session()->setFlashdata('error', 'Nomor HP sudah terdaftar. Silakan gunakan nomor HP lain.');
            return redirect()->back()->withInput();
        }

        $userData = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'profile' => 'https://res.cloudinary.com/beta7x/image/upload/v1720840088/610-6104451_image-placeholder-png-user-profile-placeholder-image-png-removebg-preview_bccniu.png',
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'verification_token' => bin2hex(random_bytes(16)),
            'role' => 'kurir',
            'created_at' => date('Y-m-d H:i:s')
        ];

        if (!$this->userModel->insert($userData)) {
            session()->setFlashdata('error', 'Terjadi kesalahan saat menyimpan data pengguna.');
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }

        $newUser = $this->userModel->where('email', $email)->first();

        $kurirData = [
            'user_id' => $newUser->id,
            'affiliate_id' => $affiliateId,
            'is_active' => $status,
            'created_at' => date('Y-m-d H:i:s')
        ];


        if (!$this->kurirModel->insert($kurirData)) {
            $this->userModel->delete($newUser->id);
            session()->setFlashdata('error', 'Terjadi kesalahan saat menyimpan data kurir.');
            return redirect()->back()->withInput()->with('errors', $this->kurirModel->errors());
        }

        session()->setFlashdata('success', 'Kurir berhasil ditambahkan.');
        return redirect()->to('/dashboard/kurir');
    }

    public function assignKurir($orderId)
    {
        $kurirId = $this->request->getPost('kurir_id');

        if (!$kurirId) {
            return redirect()->back()->with('swal_error', 'Kurir tidak valid.');
        }

        $orderModel = new \App\Models\OrderModel();

        $order = $orderModel->find($orderId);
        if (!$order) {
            return redirect()->back()->with('swal_error', 'Pesanan tidak ditemukan.');
        }

        $orderModel->update($orderId, [
            'kurir_id' => $kurirId
        ]);

        return redirect()->back()->with('swal_success', 'Kurir berhasil ditugaskan.');
    }


    public function uploadProofImage($orderId)
    {
        $orderModel = new OrderModel();
        $order = $orderModel->find($orderId);

        if (!$order) {
            return redirect()->back()->with('swal_error', 'Pesanan tidak ditemukan.');
        }

        $file = $this->request->getFile('bukti_pengiriman');

        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return redirect()->back()->with('swal_error', 'Gagal mengunggah bukti pengiriman.');
        }

        $filePath = $file->getTempName();
        $uploadResult = $this->uploadHelper->upload($filePath);

        if (!isset($uploadResult['secure_url'])) {
            return redirect()->back()->with('swal_error', 'Gagal mengunggah gambar ke Cloudinary.');
        }

        $order->delivery_proof = $uploadResult['secure_url'];
        $order->delivery_status = 'diterima';
        $orderModel->save($order);

        return redirect()->back()->with('swal_success', 'Bukti pengiriman berhasil diunggah dan status diperbarui.');
    }
}
