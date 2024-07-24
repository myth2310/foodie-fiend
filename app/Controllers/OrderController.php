<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class OrderController extends BaseController
{
    public function index()
    {
        return view('pages/my_order');
    }

    public function checkout()
    {
        $order_data = [
            'menu_id' => $this->request->getPost('menu_id'),
            'menu_name' => $this->request->getPost('menu_name'),
            'menu_description' => $this->request->getPost('menu_description'),
            'quantity' => $this->request->getPost('quantity'),
            'price' => $this->request->getPost('price'),
        ];
        return view('pages/checkout', ['order_data' => $order_data]);
    }
}
