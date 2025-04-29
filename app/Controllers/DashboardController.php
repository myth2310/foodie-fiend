<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\OrderModel;
use App\Models\UserModel;
use App\Models\CategoryModel;
use App\Models\StoreModel;

class DashboardController extends BaseController
{
    protected $categoryController;
    protected $menuController;
    protected $orderController;
    protected $store_id;
    protected $categoryModel;
    protected $userModel;
    protected $orderModel;
    protected $storeModel;


    public function __construct()
    {
        $this->categoryController = new CategoryController();
        $this->menuController = new MenuController();
        $this->orderController = new OrderController();
        $this->categoryModel = new CategoryModel();
        $this->userModel = new UserModel();
        $this->orderModel = new OrderModel();
        $this->storeModel = new StoreModel();
        $store = session()->get('store_id');
        if (is_string($store)) {
            $this->store_id = $store;
        }
    }

    public function index()
    {
        if (session()->get('role') != 'store') {
            return redirect()->route('home');
        }
        $menuModel = new MenuModel();

        $storeId = session()->get('user_id');
        $id_store = session()->get('store_id');
        $menus = $this->menuController->getAllByStoreId($storeId);

        $store = $this->userModel->getUserWithStore($storeId);

        $totalMenu = $menuModel
            ->where('store_id', $id_store)
            ->countAllResults();


        $orderModel = new OrderModel();

        $totalTransaksi = $orderModel
            ->where('store_id', $id_store)
            ->countAllResults();

        $orderModel = new OrderModel();

        $totalPendapatan = $orderModel
            ->where('store_id', $id_store)
            ->where('status', 'selesai')
            ->where('delivery_status', 'selesai')
            ->selectSum('total_price', 'sum_price')
            ->selectSum('shipping_cost', 'sum_shipping')
            ->get()
            ->getRow();

        $totalPendapatan = $totalPendapatan->sum_price + $totalPendapatan->sum_shipping;

        if (!$store) {
            session()->setFlashdata('swal_error', 'Data store tidak ditemukan.');
            return redirect()->back();
        }

        return view('pages/dashboard', ['data' => [
            'menus' => $menus,
            'store' => $store,
            'totalMenu' => $totalMenu,
            'totalTransaksi' => $totalTransaksi,
            'totalPendapatan' => $totalPendapatan,
        ]]);
    }


    public function menu(): string
    {
        $menuController = new MenuController();
        $categoryController = new CategoryController();
        $menus = $menuController->getAllByStoreId($this->store_id);
        $categories = $this->categoryModel->findAll();

        return view('pages/menu', [
            'page' => 'Menu',
            'data' => [
                'menu' => $menus,
                'category' => $categories
            ],
            'title' => 'Menu',
        ]);
    }

    public function category(): string
    {
        $categoryController = new CategoryController();
        $categories = $categoryController->getAllByStoreId($this->store_id);
        return view('pages/category', [
            'page' => 'Kategori',
            'data' => $categories,
        ]);
    }
    public function detailOrder($id): string
    {
        $orderModel = new OrderModel();
        $orderDetails = $orderModel->getDetailOrder($id);
        return view('pages/detail_order', [
            'orderDetails' => $orderDetails
        ]);
    }

    public function profile(): string
    {
        $storeId = session()->get('user_id');
        $store = $this->storeModel->getStoreWithUser($storeId);

        return view('pages/profile', [
            'store' => $store,
        ]);
    }

    public function downloadKTP($storeId)
    {
        $ktpStore = $this->storeModel->getStoreWithUser($storeId);
        return $this->response->download($ktpStore->ktp_url, null)
            ->setFileName('KTP_' . $storeId . '.png');
    }


    public function order(): string
    {
        $orderModel = new OrderModel();
        $perPage = 5;

        $orders = $orderModel->getOrdersByStoreId($this->store_id, $perPage);
        $pager = $orderModel->pager;

        return view('pages/order', [
            'page' => 'Pesanan',
            'orders' => $orders,
            'pager' => $pager
        ]);
    }


    // ADMIN CONTROLLER
    public function dashboard()
    {
        $userModel = new UserModel();

        $totalMitra = $userModel
            ->where('role', 'store')
            ->where('is_verif', 1)
            ->countAllResults();

        $totalPengajuan = $userModel
            ->where('role', 'store')
            ->where('is_verif', 0)
            ->countAllResults();

        $orderModel = new OrderModel();

        $totalTransaksi = $orderModel->countAllResults();
        $totalPendapatan = $orderModel->selectSum('application_fee')->get()->getRow()->application_fee;

        $data = [
            'totalMitra' => $totalMitra,
            'totalPengajuan' => $totalPengajuan,
            'totalTransaksi' => $totalTransaksi,
            'totalPendapatan' => $totalPendapatan
        ];

        return view('admin/dashboard_admin.php', $data);
    }

    public function mitra()
    {
        $userModel = new UserModel();
        $perPage = 5;

        $store = $userModel->getStore($this->store_id, $perPage);
        $pager = $userModel->pager;


        return view('admin/mitra.php', [
            'page' => 'Mitra UMKM',
            'store' => $store,
            'title' => 'Halaman Mitra UMKM',
            'pager' => $pager
        ]);
    }

    public function detailTrnsaksi($id)
    {
        $orderModel = new OrderModel();
        $orderDetails = $orderModel->getDetailOrder($id);
        return view('admin/detail_transaksi', [
            'orderDetails' => $orderDetails
        ]);
    }

    public function transaksi()
    {
        $orderModel = new OrderModel();

        $perPage = 10;
        $orders = $orderModel->getOrders($perPage);

        $pager = $orderModel->pager;
        return view('admin/transaksi', [
            'page' => 'Transakai Pemesanan',  
            'orders' => $orders,  
            'pager' => $pager]);
    }


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

    public function detail($id)
    {
        $userModel = new UserModel();
        $data = $userModel->getUmkmById($id);

        $customerLat = -6.8737575;
        $customerLon = 109.0855475;

        $umkmLat = -6.869123;
        $umkmLon = 109.100958;
        $distance = $this->haversineDistance($customerLat, $customerLon, $umkmLat, $umkmLon);
        $ratePerKm = 1000;

        $totalHarga = $distance * $ratePerKm;

        return view('admin/detail_mitra', [
            'umkm' => $data,
            'distance' => $distance,
            'totalHarga' => $totalHarga
        ]);
    }

    public function viewPdf($fileUrl)
    {

        $fileUrl = urldecode($fileUrl);
        if (filter_var($fileUrl, FILTER_VALIDATE_URL) === false) {
            return "Link PDF tidak valid.";
        }
        return view('admin/view_pdf', ['fileUrl' => $fileUrl]);
    }

    public function verify($storeId)
    {
        $store = $this->userModel->find($storeId);

        if ($store) {
            if ($store->is_verif == 1) {
                return $this->response->setJSON(['success' => false, 'message' => 'UMKM sudah terverifikasi']);
            }
            $updated = $this->userModel->update($storeId, ['is_verif' => 1]);

            if ($updated) {
                $this->sendVerificationEmail($store->email);

                return $this->response->setJSON(['success' => true, 'message' => 'UMKM berhasil diverifikasi']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal memverifikasi UMKM']);
            }
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'UMKM tidak ditemukan']);
        }
    }

    public function delete($id)
    {
        $user = $this->userModel->withDeleted()->find($id);
        
        if (!$user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User tidak ditemukan.'
            ]);
        }
    
        if ($this->userModel->delete($id, true)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'UMKM berhasil dihapus.'
            ]);
        }
    
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal menghapus UMKM.'
        ]);
    }
    
    
    
    

    private function sendVerificationEmail($email)
    {
        // Mengatur email
        $emailService = \Config\Services::email();

        $emailService->setFrom('no-reply@yourdomain.com', 'Admin');
        $emailService->setTo($email);
        $emailService->setSubject('Akun UMKM Anda Telah Terverifikasi');
        $emailService->setMessage('Halo, Akun UMKM Anda telah berhasil diverifikasi. Terima kasih telah bergabung.');

        if ($emailService->send()) {
            return true;
        } else {
            log_message('error', 'Email verification failed: ' . $emailService->printDebugger());
            return false;
        }
    }
}
