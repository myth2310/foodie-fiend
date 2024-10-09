<?php

namespace App\Controllers;

use App\Models\MenuModel;

class DashboardController extends BaseController
{
    protected $categoryController;
    protected $menuController;
    protected $orderController;
    protected $store_id;



    public function __construct()
    {
        $this->categoryController = new CategoryController();
        $this->menuController = new MenuController();
        $this->orderController = new OrderController();
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

        // dd(session()->get('store_id')->id);
        $menus = $this->menuController->getAllByStoreId($this->store_id);
        $categories = $this->categoryController->getAllByStoreId($this->store_id);

        return view('pages/dashboard', ['data' => [
            'menus' => $menus,
            'categories' => $categories,
        ]]);
    }

    public function menu(): string
    {
        $menuController = new MenuController();
        $categoryController = new CategoryController();
        $menus = $menuController->getAllByStoreId($this->store_id);
        $categories = $categoryController->getAllByStoreId($this->store_id);

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

    public function profile(): string
    {
        return view('pages/profile', ['page' => 'Profil']);
    }

    public function order(): string
    {
        return view('pages/order', ['page' => 'Pesanan']);
    }
}
