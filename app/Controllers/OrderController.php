<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\OrderEntity;
use App\Models\MenuModel;
use App\Models\OrderModel;
use CodeIgniter\HTTP\ResponseInterface;

class OrderController extends BaseController
{
    protected $order;
    protected $orderModel;

    public function __construct()
    {
        $this->order = new OrderEntity();
        $this->orderModel = new OrderModel();
    }

    public function create()
    {
        $user_id = session()->get('user_id');
        $this->order->user_id = $user_id;
        $this->order->menu_id = $this->request->getPost('menu_id');
        $this->order->quantity = $this->request->getPost('quantity');
        $this->order->price = $this->request->getPost('price');
        $this->order->total_price = $this->order->price * $this->order->quantity;

        if (!$this->orderModel->save($this->order)) {
            return redirect()->back()->withInput()->with('errors', [$this->orderModel->errors()]);
        }

        return redirect()->back()->withInput()->with('messages', ['Pesanana berhasil dibuat']);
    }

    public function index()
    {
        return view('pages/my_order');
    }

    public function addToChart($menu_id)
    {
        $menuModel = new MenuModel();
        $orderModel = new OrderModel();

        $menu = $menuModel->find($menu_id);
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
