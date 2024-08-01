<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\UserEntity;
use App\Models\ChartModel;
use App\Models\OrderModel;
use App\Models\StoreModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    protected $user;
    protected $userModel;
    protected $chartModel;
    protected $orderModel;
    protected $storeModel;
    protected $emailController;

    public function __construct()
    {
        $this->user = new UserEntity();
        $this->userModel = new UserModel();
        $this->chartModel = new ChartModel();
        $this->orderModel = new OrderModel();
        $this->storeModel = new StoreModel();
        $this->emailController = new EmailController();
    }

    // Fungsi menampilkan semua user
    public function index()
    {
        $data['users'] = $this->userModel->findAll();

        return view('users/index', $data);
    }

    public function dashboard()
    {
        if(session()->get('role') != 'user') {
            return redirect()->to('/');
        }
        return view('pages/user/index');
    }

    public function charts()
    {
        $user_id = session()->get('user_id');
        $data = $this->chartModel->getAllChartWithMenu($user_id);
        return view('pages/user/my_chart', ['data' => $data]);
    }

    public function orders()
    {
        $orderStatus = $this->request->getGet('status');
        $data = $this->orderModel->where('status', $orderStatus)->findAll();
        return view('pages/user/my_order', ['data' => $data]);
    }

    public function settings()
    {
        return view('pages/user/my_setting');
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
        $this->user->name = $this->request->getPost('name');
        $this->user->email = $this->request->getPost('email');
        $this->user->phone = $this->request->getPost('phone');
        $this->user->profile = 'https://res.cloudinary.com/beta7x/image/upload/v1720840088/610-6104451_image-placeholder-png-user-profile-placeholder-image-png-removebg-preview_bccniu.png';
        $this->user->setPassword($this->request->getPost('password'));
        
        // Buat token untuk verifikasi pengguna
        $token = bin2hex(random_bytes(16));
        $this->user->verification_token = $token;

        $storeUser = $this->userModel->insert($this->user);
        if (!$storeUser) {
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }
        
        $data = $this->userModel->where('email', $this->user->email)->first();
        switch ($data->role) {
            case 'store':
                $this->setSession($data, true);
                break;
            default:
                $this->setSession($data);
                break;
        }
        
        $messages = ['Pengguna berhasil dibuat'];
        
        if (!$this->emailController->sendVerification($data->email, $data->name, $token)) {
            return redirect()->to('/')->with('errors', ['Gagal mengirim email verifikasi']);
        }

        array_push($messages, 'Email verifikasi berhasil terkirim');
        return redirect()->to('/')->with('messages', $messages);
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
        $user = $this->userModel->find($id);
        
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
        if (!$this->userModel->save($userEntity)) {
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }

        return redirect()->to('/users')->with('message', 'Pengguna berhasil diperbarui');
    }

    // Fungsi verifikasi email pengguna
    public function verificate($token)
    {
        $user = $this->userModel->where('verification_token', $token)->first();

        if ($user) {
            $this->userModel->update($user->id, [
                'is_verif' => 1,
                'verification_token' => null,
            ]);

            switch ($user->role) {
                case 'store':
                    $this->setSession($user, true);
                    break;
                default:
                    $this->setSession($user);
                    break;
            }

            return redirect()->to('/')->with('messages', ['Berhasil verifikasi email pengguna']);
        } else {
            return redirect()->to('/')->with('errors', ['Gagal verifikasi email pengguna']);
        }
    }

    // Fungsi untuk setting session pengguna
    public function setSession($data, $with_storeId = false)
    {
        $session_data = [
            'user_id' => $data->id,
            'name' => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
            'role' => $data->role,
            'profile' => $data->profile,
            'logged_in' => TRUE,
        ];
        if ($with_storeId) {
            $store_id = $this->storeModel->where('user_id', $data->id)->first();
            $session_data['store_id'] = $store_id->id;
        }

        session()->set($session_data);
    }
}
