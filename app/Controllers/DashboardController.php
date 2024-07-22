<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        $categoryController = new CategoryController();
        if (session()->get('role') != 'store') {
            return redirect()->route('home');
        }

        return view('pages/dashboard', $categoryController->index());
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
