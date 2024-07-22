<?php

namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function register(): string
    {
        return view('pages/signup');
    }

    public function login(): string
    {
        $data = ['title' => 'Halaman Daftar'];
        return view('pages/login', $data);
    }
    public function authenticate()
    {
        $session = session();
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $data = $model->where('email', $email)->first();
        if ($data) {
            $passwordHash = $data->password;
            $authenticatePassword = password_verify($password, $passwordHash);

            if ($authenticatePassword) {
                $session_data = [
                    'id' => $data->id,
                    'name' => $data->name,
                    'email' => $data->email,
                    'role' => $data->role,
                    'profile' => $data->profile,
                    'logged_in' => TRUE,
                ];
                $session->set($session_data);
                $session->setFlashdata('message', ['Sukses login']);

                if ($data->role == 'store' || $data->role == 'admin') {
                    return redirect()->route('dashboard');
                }

                return redirect()->route('home');
            } else {
                $session->setFlashdata('errors', ['Email or password is incorrect.']);
                return redirect()->to('/');
            }
        }
        $session->setFlashdata('errors', ['Email atau password salah.']);
        return redirect()->to('/');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('/');
    }
}
