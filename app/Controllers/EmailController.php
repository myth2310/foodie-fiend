<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class EmailController extends BaseController
{
    protected $from_email;
    protected $smtp_server;
    protected $smtp_port;
    protected $smtp_user;
    protected $smtp_password;
    protected $python_path;
    
    public function __construct()
    {
        $this->from_email = getenv('EMAIL_FROM');
        $this->smtp_server = getenv('SMTP_HOST');
        $this->smtp_port = intval(getenv('SMTP_PORT'));
        $this->smtp_user = getenv('SMTP_USER');
        $this->smtp_password = getenv('SMTP_PASS'); 
        $this->python_path = getenv('PYTHON_PATH');
    }
    
    private function invokeMail($kwargs): string
    {
        $encoded_kwargs = base64_encode($kwargs);
        $command = escapeshellcmd("$this->python_path scripts/postman.py '$encoded_kwargs'");
        return shell_exec($command);
    }

    public function sendVerification($to_email, $name, $token): bool
    {
        $kwargs = json_encode([
            'to_email' => $to_email,
            'from_email' => $this->from_email,
            'smtp_server' => $this->smtp_server,
            'smtp_port' => $this->smtp_port,
            'smtp_username' => $this->smtp_user,
            'smtp_password' => $this->smtp_password,
            'subject' => '[Foodie Fiend] Verifikasi Email',
            'email_type' => 'html',
            'template' => 'email_verification.html',
            'name' => $name,
            'verif_link' => base_url('/verification/' . $token)
        ]);

        $output = $this->invokeMail($kwargs);
        
        if(strpos($output, 'Email berhasil dikirim!') !== false) {
            return true;
        } else {
            return false;
        }
    }

    public function sendOTP($otp_code, $to_email, $name): bool
    {
        $kwargs = json_encode([
            'to_email' => $to_email,
            'from_email' => $this->from_email,
            'smtp_server' => $this->smtp_server,
            'smtp_port' => $this->smtp_port,
            'smtp_username' => $this->smtp_user,
            'smtp_password' => $this->smtp_password,
            'subject' => '[Foodie Fiend] Kode Verifikasi OTP',
            'email_type' => 'html',
            'template' => 'otp_verification.html',
            'name' => $name,
            'otp_code' => $otp_code
        ]);

        $output = $this->invokeMail($kwargs);
        
        if(strpos($output, 'Email berhasil dikirim!') !== false) {
            return true;
        } else {
            return false;
        }
    }
}
