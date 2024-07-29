<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\UserEntity;
use App\Models\ChartModel;
use App\Models\OrderModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    protected $user;
    protected $userModel;
    protected $chartModel;

    protected $orderModel;

    public function __construct()
    {
        $this->user = new UserEntity();
        $this->userModel = new UserModel();
        $this->chartModel = new ChartModel();
        $this->orderModel = new OrderModel();
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
        
        $storeUser = $this->userModel->insert($this->user);
        if (!$storeUser) {
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }
        
        $data = $this->userModel->where('email', $this->user->email)->first();
        $session_data = [
            'id' => $data->id,
            'name' => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
            'role' => $data->role,
            'profile' => $data->profile,
            'logged_in' => TRUE,
        ];
        session()->set($session_data);
        
        $messages = ['Pengguna berhasil dibuat'];
        
        // $email = \Config\Services::email();
        // $email->setFrom('no-reply@microsaas.my.id', 'Foodie Fiend');
        // $email->setTo($this->user->email);
        // $email->setSubject('Testing mailtrap');
        // $email->setMessage('This is a test verification email using mailtrap in Codeigniter 4');

        // if ($email->send()) {
        //     array_push($messages, 'Email verifikasi terkirim');
        // } else {
        //     $this->logger->error($email->printDebugger(['headers']));
        //     array_push($messages, $email->printDebugger(['headers']));
        // }
        
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
}
