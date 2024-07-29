<?php

namespace App\Controllers;
use App\Models\MenuModel;

class DashboardController extends BaseController
{
    protected $categoryController;
    protected $menuController;
    protected $orderController;

    public function __construct()
    {
        $this->categoryController = new CategoryController();
        $this->menuController = new MenuController();
        $this->orderController = new OrderController();
    }

    public function index()
    {
        if (session()->get('role') != 'store') {
            return redirect()->route('home');
        }
        $store_id = session()->get('store_id')->id;

        // dd(session()->get('store_id')->id);
        $menus = $this->menuController->getAllByStoreId($store_id);
        $categories = $this->categoryController->getAllByStoreId($store_id);

        return view('pages/dashboard', ['data' => [
            'menus' => $menus,
            'categories' => $categories,
        ]]);
    }
    
    public function menu(): string
    {
        $menuController = new MenuController();
        $menus = $menuController->index();
        return view('pages/menu', [
            'page' => 'Menu',
            'data' => $menus,
            'title' => 'Menu',
        ]);
    }

    public function category(): string
    {
        $categoryController = new CategoryController();
        $categories = $categoryController->index();
        return view('pages/category', [
            'page' => 'Kategori',
            'data' => $categories,
        ]);
    }

    public function profile(): string
    {
        return view('pages/profile', ['page' => 'Profil']);
    }

    public function order(): string
    {
        return view('pages/order', ['page' => 'Pesanan']);
    }
}
