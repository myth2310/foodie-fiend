<?php

namespace App\Controllers;
use App\Models\ChartModel;

class Home extends BaseController
{
    protected $chartModel;
    protected $storeController;

    public function __construct()
    {
        $this->chartModel = new ChartModel();
        $this->storeController = new StoreController();
    }

    public function index(): string
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
