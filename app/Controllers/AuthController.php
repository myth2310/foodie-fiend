<?php

namespace App\Controllers;

use App\Models\StoreModel;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;
    protected $storeModel;
    protected $userController;
    protected $otpController;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->storeModel = new StoreModel();
        $this->userController = new UserController();
        $this->otpController = new OTPController();
    }

    public function otpLogin()
    {
        return view('pages/otp_login');
    }

    public function verifyOTP()
    {
        $secret = getenv('OTP_SECRET_KEY');
        $otp_code = $this->request->getPost('otp_code');

        if (!$this->otpController->validateOTP($secret, $otp_code)) {
            return redirect()->back()->with('errors', ['Gagal verifikasi kode OTP']);
        }

        return redirect()->to('/')->with('messages', ['Berhasil verifikasi kode OTP']);
    }

    public function authenticate()
    {
        $session = session();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $data = $this->userModel->where('email', $email)->first();

        if ($data) {
            if ($data->is_verif == 0) {
                $session->setFlashdata('error', 'Akun Anda belum diverifikasi. Silakan cek email Anda untuk verifikasi.');
                return redirect()->to('/');
            }
            $passwordHash = $data->password;
            $authenticatePassword = password_verify($password, $passwordHash);

            if ($authenticatePassword) {
                switch ($data->role) {
                    case 'store':
                        $this->userController->setSession($data, true);
                        break;
                    case 'admin':
                    case 'kurir':
                    default:
                        $this->userController->setSession($data);
                        break;
                }

                $session->setFlashdata('success', 'Sukses login');
                if ($data->role == 'store') {
                    return redirect()->to('/dashboard');
                } else if ($data->role == 'admin') {
                    return redirect()->to('/admin/dashboard');
                } else if ($data->role == 'kurir') {
                    return redirect()->to('/kurir/dashboard');
                }

                return redirect()->route('home');
            } else {
                $session->setFlashdata('error', 'Email atau password salah.');
                return redirect()->to('/');
            }
        }

        $session->setFlashdata('error', 'Email atau password salah.');
        return redirect()->to('/');
    }



    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('/');
    }
}
