<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\OrderEntity;
use App\Models\ChartModel;
use App\Models\MenuModel;
use App\Models\OrderModel;
use CodeIgniter\HTTP\ResponseInterface;

class OrderController extends BaseController
{
    protected $order;
    protected $orderModel;
    protected $chartModel;
    protected $storeController;
    protected $paymentController;

    public function __construct()
    {
        $this->order = new OrderEntity();
        $this->orderModel = new OrderModel();
        $this->chartModel = new ChartModel();
        $this->storeController = new StoreController();
        $this->paymentController = new PaymentController();
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
        $user_id = session()->get('user_id');
        $dataChart = $this->chartModel->getAllChartWithMenu($user_id);
        $dataStore = $this->storeController->getAllStore();
        $data = [
            'title' => 'Halaman Utama | Foodie Fiend',
            'hero_img' => 'https://images.squarespace-cdn.com/content/v1/61709486e77e1d27c181981c/a9eb540d-aff8-4360-8354-1d35c856a561/0223_UrbanSpace_ZeroIrving_LizClayman_160.png',
            'items' => $dataStore,
            'charts' => $dataChart,
            'use_chart_button' => false,
            'use_hero_text' => true,
        ];

        return view('pages/my_order', $data);
    }

    public function checkout()
    {
        $price = $this->request->getPost('price');
        $quantity = $this->request->getPost('quantity');
        $data = [
            'store_id' => $this->request->getPost('store_id'),
            'menu_id' => $this->request->getPost('menu_id'),
            'price' => $price,
            'quantity' => $quantity,
        ];
        $snapToken = $this->paymentController->create($data);
        $order_data = [
            'menu_id' => $this->request->getPost('menu_id'),
            'menu_name' => $this->request->getPost('menu_name'),
            'menu_description' => $this->request->getPost('menu_description'),
            'quantity' => $quantity,
            'price' => $price,
            'image_url' => $this->request->getPost('image_url'),
            'snapToken' => $snapToken,
        ];

        return view('pages/checkout', ['order_data' => $order_data]);
    }

    public function getAllOrders($user_id, $order_status)
    {
        return $this->orderModel->getAllOrdersWithMenus($user_id, $order_status);
    }
}
