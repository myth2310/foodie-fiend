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
    protected $orderController;

    public function __construct()
    {
        $this->user = new UserEntity();
        $this->userModel = new UserModel();
        $this->chartModel = new ChartModel();
        $this->orderModel = new OrderModel();
        $this->storeModel = new StoreModel();
        $this->emailController = new EmailController();
        $this->orderController = new OrderController();
    }

    // Fungsi menampilkan semua user
    public function index()
    {
        $data['users'] = $this->userModel->findAll();

        return view('users/index', $data);
    }

    public function dashboard()
    {
        if (session()->get('role') != 'user') {
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
        $user_id = session()->get('user_id');
        $orderStatus = $this->request->getGet('status');


        $my_order = $this->orderModel->getAllOrdersWithMenus($user_id, $orderStatus);

        $pager = $this->orderModel->pager;

        $data = [
            'data' => $my_order,
            'pager' => $pager,
        ];

        return view('pages/user/my_order', $data);
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

    public function store()
    {
        // Ambil data dari input
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $password = $this->request->getPost('password');


        $existingEmail = $this->userModel->where('email', $email)->first();
        if ($existingEmail) {
            session()->setFlashdata('error', 'Email sudah terdaftar. Silakan gunakan email lain.');
            return redirect()->back()->withInput();
        }

        $existingPhone = $this->userModel->where('phone', $phone)->first();
        if ($existingPhone) {
            session()->setFlashdata('error', 'Nomor HP sudah terdaftar. Silakan gunakan nomor HP lain.');
            return redirect()->back()->withInput();
        }

        $this->user->name = $name;
        $this->user->email = $email;
        $this->user->phone = $phone;
        $this->user->profile = 'https://res.cloudinary.com/beta7x/image/upload/v1720840088/610-6104451_image-placeholder-png-user-profile-placeholder-image-png-removebg-preview_bccniu.png';
        $this->user->setPassword($password);

        $token = bin2hex(random_bytes(16));
        $this->user->verification_token = $token;

        $storeUser = $this->userModel->insert($this->user);
        if (!$storeUser) {
            session()->setFlashdata('error', 'Terjadi kesalahan dalam penyimpanan data pengguna.');
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
        session()->setFlashdata('success', 'Pengguna berhasil dibuat!');
        return redirect()->to('/');
    }



    public function edit($id)
    {
        $modelModel = new UserModel();
        $user = $modelModel->find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan');
        }
        return view('users/edit', ['user' => $user]);
    }


    // public function update($id)
    // {
    //     $user = $this->userModel->find($id);

    //     if (!$user) {
    //         return redirect()->back()->with('errors', ['Pengguna tidak ditemukan']);
    //     }

    //     $data = $this->request->getPost();
    //     if (empty($data['password'])) {
    //         unset($data['password']);
    //     }

    //     // Assign data ke UserEntity
    //     $userEntity = new UserEntity($data);

    //     if (isset($data['password'])) {
    //         $userEntity->setPassword($data['password']);
    //     }

    //     if (!$this->userModel->save($userEntity)) {
    //         return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
    //     }

    //     return redirect()->to('/users')->with('message', 'Pengguna berhasil diperbarui');
    // }


    public function update($id)
    {

        $userModel = new UserModel();
        $name = $this->request->getPost('name');
        $address = $this->request->getPost('address');
        $latitude = $this->request->getPost('latitude');
        $longitude = $this->request->getPost('longitude');

        $updateData = [
            'name' => $name,
            'address' => $address,
            'lat' => $latitude,
            'long' => $longitude,
        ];

        // Cek apakah update berhasil
        if ($userModel->update($id, $updateData)) {
            // Update session dengan data terbaru
            session()->set($updateData);
            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

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

    public function setSession($data, $with_storeId = false)
    {
        $session_data = [
            'user_id' => $data->id,
            'name' => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
            'lat' => $data->lat,
            'long' => $data->long,
            'address' => $data->address,
            'role' => $data->role,
            'profile' => $data->profile,
            'is_verif' => $data->is_verif,
            'logged_in' => TRUE,
        ];
        if ($with_storeId) {
            $store_id = $this->storeModel->where('user_id', $data->id)->first();
            $session_data['store_id'] = $store_id->id;
            $session_data['user_id'] = $store_id->user_id;
        }

        session()->set($session_data);
    }
}
