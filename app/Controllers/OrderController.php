<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\OrderEntity;
use App\Models\ChartModel;
use App\Models\MenuModel;
use App\Models\OrderModel;
use App\Helpers\CloudinaryHelper;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class OrderController extends BaseController
{
    protected $order;
    protected $orderModel;
    protected $userModel;
    protected $chartModel;
    protected $storeController;
    protected $paymentController;
    protected $uploadHelper;

    public function __construct()
    {
        $this->order = new OrderEntity();
        $this->orderModel = new OrderModel();
        $this->chartModel = new ChartModel();
        $this->userModel = new UserModel();
        $this->storeController = new StoreController();
        $this->paymentController = new PaymentController();
        $this->uploadHelper = new CloudinaryHelper();
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

    public function add()
    {
        $menu_id = $this->request->getPost('menu_id');
        $quantity = $this->request->getPost('quantity');
        $user_id = session()->get('user_id');
        $store_id = session()->get('store_id');
        $price = $this->request->getPost('price');
        $total_price = $quantity * $price;
        $status = 'diproses';

        $orderModel = new OrderModel();

        $data = [
            'order_id' => uniqid(),
            'user_id' => $user_id,
            'store_id' => $store_id,
            'menu_id' => $menu_id,
            'quantity' => $quantity,
            'price' => $price,
            'total_price' => $total_price,
            'status' => $status
        ];

        $orderModel->insert($data);

        return redirect()->back()->with('success', 'Order has been placed successfully.');
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

    // public function checkout()
    // {
    //     $store_id = $this->request->getPost('store_id');
    //     $menu_ids = $this->request->getPost('menu_id');
    //     $quantities = $this->request->getPost('quantity');
    //     $prices = $this->request->getPost('total_price');
    //     $menu_names = $this->request->getPost('menu_name');
    //     $image_urls = $this->request->getPost('image_url');

    //     $order_data = [];
    //     $total_price = 0;

    //     // Loop untuk setiap item di dalam pesanan
    //     foreach ($menu_ids as $index => $menu_id) {
    //         $quantity = $quantities[$index];
    //         $price = $prices[$index];
    //         $total_price += $price; // Menghitung total harga

    //         $order_data[] = [
    //             'menu_id' => $menu_id,
    //             'menu_name' => $menu_names[$index],
    //             'quantity' => $quantity,
    //             'price' => $price,
    //             'image_url' => $image_urls[$index],
    //             'status' => 'pending', 
    //         ];
    //     }

    //     // Memproses pembayaran menggunakan total harga keseluruhan
    //     $payment_data = [
    //         'store_id' => $store_id,
    //         'total_price' => $total_price
    //     ];

    //     $snapToken = $this->paymentController->create($payment_data);

    //     // Menambahkan Snap Token ke setiap item pesanan
    //     foreach ($order_data as &$item) {
    //         $item['snapToken'] = $snapToken;
    //     }

    //     $orderModel = new \App\Models\OrderModel();

    //     try {
    //         // Insert semua item pesanan
    //         foreach ($order_data as $data) {
    //             $orderModel->insert($data);
    //         }

    //         return view('pages/checkout', [
    //             'order_data' => $order_data,
    //             'snapToken' => $snapToken,
    //         ]);
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Pesanan gagal disimpan: ' . $e->getMessage());
    //     }
    // }


    // public function checkout()
    // {
    //     $price = $this->request->getPost('price');
    //     $quantity = $this->request->getPost('quantity');

    //     $data = [
    //         'store_id' => $this->request->getPost('store_id'),
    //         'menu_id' => $this->request->getPost('menu_id'),
    //         'price' => $price,
    //         'quantity' => $quantity,
    //     ];

    //     $snapToken = $this->paymentController->create($data);

    //     $order_data = [
    //         'menu_id' => $this->request->getPost('menu_id'),
    //         'menu_name' => $this->request->getPost('menu_name'),
    //         'menu_description' => $this->request->getPost('menu_description'),
    //         'quantity' => $quantity,
    //         'price' => $price,
    //         'status' => 'pending', 
    //         'image_url' => $this->request->getPost('image_url'),
    //         'snapToken' => $snapToken,
    //     ];


    //     $orderModel = new \App\Models\OrderModel();

    //     try {
    //         $orderModel->insert($order_data);
    //         $order_id = $orderModel->insertID(); 

    //         return view('pages/checkout', [
    //             'order_data' => $order_data,
    //             'order_id' => $order_id
    //         ]);
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Pesanan gagal disimpan: ' . $e->getMessage());
    //     }
    // }


    public function haversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return $distance;
    }

    public function checkout()
    {
        $store_id = $this->request->getPost('store_id');
        $stores_id = $this->request->getPost('stores_id');
        $menu_id = $this->request->getPost('menu_id');
        $price = $this->request->getPost('price');
        $quantity = $this->request->getPost('quantity');
        $menu_name = $this->request->getPost('menu_name');
        $menu_description = $this->request->getPost('menu_description');
        $image_url = $this->request->getPost('image_url');
        $user_id = session()->get('user_id');
        $charts_id = $this->request->getPost('charts_id');

        // Menghitung biaya pengiriman berdasarkan jarak
        $userModel = new UserModel();
        $store_maps = $userModel->getUserId($stores_id);
        $users_maps = $userModel->getUserId($user_id);

        $customerLat = $users_maps->lat;
        $customerLon = $users_maps->long;
        $umkmLat = $store_maps->lat;
        $umkmLon = $store_maps->long;
        $distance = $this->haversineDistance($customerLat, $customerLon, $umkmLat, $umkmLon);
        $ratePerKm = 1000;
        $shippingCost = $distance * $ratePerKm;
        $applicationFee = 2000;

        // Menghitung total harga pesanan
        $grandTotal = 0;
        if (is_array($menu_id)) {
            foreach ($menu_id as $index => $menu) {
                $totalPrice = $price[$index] * $quantity[$index];
                $grandTotal += $totalPrice;
            }
        } else {
            $totalPrice = $price * $quantity;
            $grandTotal += $totalPrice;
        }

        $grandTotal += $shippingCost + $applicationFee;

        if (!isset($charts_id)) {
            $charts_id = [];
        }

        $data = [];
        if (is_array($menu_id)) {
            foreach ($menu_id as $index => $menu) {
                $data[] = [
                    'store_id' => $store_id,
                    'menu_id' => $menu,
                    'charts_id' => isset($charts_id[$index]) ? $charts_id[$index] : null,
                    'price' => $price[$index],
                    'quantity' => $quantity[$index],
                    'menu_name' => $menu_name[$index],
                    'menu_description' => $menu_description[$index],
                    'image_url' => $image_url[$index]
                ];
            }
        } else {
            $data[] = [
                'store_id' => $store_id,
                'menu_id' => $menu_id,
                'charts_id' => $charts_id,
                'price' => $price,
                'quantity' => $quantity,
                'menu_name' => $menu_name,
                'menu_description' => $menu_description,
                'image_url' => $image_url
            ];
        }

        try {
            $snapToken = $this->paymentController->create($data, $grandTotal, $applicationFee, $shippingCost);
        } catch (\Exception $e) {
            log_message('error', 'Gagal mendapatkan Snap Token: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mendapatkan Snap Token');
        }

        if (!$snapToken) {
            log_message('error', 'Snap Token tidak valid.');
            return redirect()->back()->with('error', 'Gagal mendapatkan Snap Token');
        }

        $order_data = [];
        foreach ($data as $item) {
            $order_data[] = [
                'menu_id' => $item['menu_id'],
                'menu_name' => $item['menu_name'],
                'menu_description' => $item['menu_description'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'status' => 'selesai',
                'image_url' => $item['image_url'],
                'snapToken' => $snapToken,
                'charts_id' => $item['charts_id'],
                'application_fee' => $applicationFee,
                'shipping_cost' => $shippingCost,
            ];
        }

        $orderModel = new \App\Models\OrderModel();
        $chartModel = new \App\Models\ChartModel();
        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            if (count($order_data) > 1) {
                $orderModel->insertBatch($order_data);
            } else {
                foreach ($order_data as $order) {
                    $orderModel->insert($order);
                }
            }

            $order_id = $orderModel->insertID();

            if (is_array($charts_id)) {
                foreach ($charts_id as $id) {
                    $chartModel->delete($id);
                }
            } elseif ($charts_id !== null) {
                $chartModel->delete($charts_id);
            }

            if ($db->transStatus() === false) {
                $db->transRollback();
                throw new \Exception('Pesanan gagal disimpan.');
            } else {
                $db->transCommit();
            }

            return view('pages/checkout', [
                'order_data' => $order_data,
                'order_id' => $order_id,
                'shipping_cost' => $shippingCost,
                'application_fee' => $applicationFee,
                'grand_total' => $grandTotal
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Pesanan gagal disimpan: ' . $e->getMessage());
            $db->transRollback();
            $session = session();
            $session->setFlashdata('error', 'Pesanan gagal disimpan: ' . $e->getMessage());
            return redirect()->back();
        }
    }


    public function updateDeliveryStatus($orderId)
    {
        $newStatus = $this->request->getPost('status_pengantaran');

        $orderModel = new OrderModel();
        $order = $orderModel->find($orderId);

        if ($order) {
            $order->delivery_status = $newStatus;
            $orderModel->save($order);
            return redirect()->back()->with('swal_success', 'Status pengiriman berhasil diperbarui.');
        } else {
            return redirect()->back()->with('swal_error', 'Pesanan tidak ditemukan.');
        }
    }

    public function updateDeliveryStatusDone($orderId)
    {
        $orderModel = new OrderModel();
        $order = $orderModel->find($orderId);

        if ($order) {
            $order->delivery_status = 'selesai';
            $orderModel->save($order);
            return redirect()->back()->with('swal_success', 'Status pengiriman berhasil diperbarui.');
        } else {
            return redirect()->back()->with('swal_error', 'Pesanan tidak ditemukan.');
        }
    }



    public function getAllOrders($user_id, $order_status)
    {
        return $this->orderModel->getAllOrdersWithMenus($user_id, $order_status);
    }

    public function uploadProofImage($orderId)
    {
        $orderModel = new OrderModel();
        $order = $orderModel->find($orderId);

        if (!$order) {
            return redirect()->back()->with('swal_error', 'Pesanan tidak ditemukan.');
        }

        $file = $this->request->getFile('bukti_pengiriman');

        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return redirect()->back()->with('swal_error', 'Gagal mengunggah bukti pengiriman.');
        }

        $filePath = $file->getTempName();
        $uploadResult = $this->uploadHelper->upload($filePath);

        if (!isset($uploadResult['secure_url'])) {
            return redirect()->back()->with('swal_error', 'Gagal mengunggah gambar ke Cloudinary.');
        }

        $order->delivery_proof = $uploadResult['secure_url'];
        $order->delivery_status = 'diterima';
        $orderModel->save($order);

        return redirect()->back()->with('swal_success', 'Bukti pengiriman berhasil diunggah dan status diperbarui.');
    }
}
