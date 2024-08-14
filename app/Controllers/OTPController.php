<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class OTPController extends BaseController
{
    protected $emailController;

    public function __construct()
    {
        $this->emailController = new EmailController();
    }

    public function generateOTP()
    {
        $name = $this->request->getPost('name');
        $userEmail = $this->request->getPost('email');
        $secret = $this->generateSecret($userEmail);
        $otp = $this->createOTP($secret);

        if (!$this->emailController->sendOTP($otp, $userEmail, $name)) {
            return redirect()->back()->with('errors', ['Gagal mengirim kode OTP']);
        }
        return redirect()->back()->with('messages', ['Berhasil mengirim kode OTP']);
    }

    private function generateSecret($email)
    {
        // Generate kunci rahasia berdasarkan email pengguna
        return hash('sha256', $email . getenv('OTP_SECRET_KEY'));
    }

    private function createOTP($secret)
    {
        // Generate kode OTP berdasarkan kunci rahasia dan waktu sekarang
        $timeSlot = floor(time() / 300); // Time slot 5 menit
        return substr(hash_hmac('sha1', $timeSlot, $secret), 0, 6); // 6 digit pertama dari hash
    }

    public function validateOTP($secret, $otp): bool
    {
        $timeSlot = floor(time() / 300);

        for ($i=-1; $i <= 1; $i++) { 
            $generatedOTP = substr(hash_hmac('sha1', $timeSlot + $i, $secret), 0, 6);
            if ($otp === $generatedOTP) {
                return true;
            }
        }

        return false;
    }
}
