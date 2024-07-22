<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class EmailController extends BaseController
{
    public function sendEmail()
    {
        $payload = $this->request->getJSON();
        $email = service('email');
        // $email->setFrom('adepriyantowidies@gmail.com', 'Foodie Fiend');
        $email->setTo($payload->recipient);
        $email->setSubject('Test email sending');
        $email->setMessage('This is a test email');

        if ($email->send()) {
            return $this->response->setJSON
            (['status' => 'success']);
        }
        $data = $email->printDebugger(['header']);
        return $this->response->setJSON([
            'status' => 'fail',
            'data' => $data,
        ]);
    }
}
