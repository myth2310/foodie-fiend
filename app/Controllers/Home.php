<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $storeController = new StoreController();
        $dataStore = $storeController->getAllStore();
        $data = [
            'title' => 'Halaman Utama | Foodie Fiend',
            'hero_img' => 'https://images.squarespace-cdn.com/content/v1/61709486e77e1d27c181981c/a9eb540d-aff8-4360-8354-1d35c856a561/0223_UrbanSpace_ZeroIrving_LizClayman_160.png',
            'items' => $dataStore,
            'use_chart_button' => false,
            'use_hero_text' => true,
        ];

        return view('pages/index', $data);
    }

    public function spiner(): string
    {
        return view('partial/preloader');
    }

    public function dasboard(): string
    {
        return view('pages/dasboard');
    }
}
