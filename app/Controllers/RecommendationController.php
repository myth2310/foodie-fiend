<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ChartModel;
use App\Models\MenuModel;
use App\Models\ReviewModel;
use CodeIgniter\HTTP\ResponseInterface;

class RecommendationController extends BaseController
{
    protected $menuModel;
    protected $chartModel;
    protected $reviewModel;
    protected $storeController;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
        $this->chartModel = new ChartModel();
        $this->reviewModel = new ReviewModel();
        $this->storeController = new StoreController();
    }

    private function get_recommendations($user_id)
    {
        $client = curl_init();
        curl_setopt($client, CURLOPT_URL, "https://anumerta.microsaas.my.id/api/recommendation/'$user_id'");
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($client);
        curl_close($client);

        $recommendedMenuIds = json_decode($output, true);
 
        $menus = $this->reviewModel->getMenusWithRating($recommendedMenuIds);

        return $menus;
    }

    public function index()
    {
        $user_id = session()->get('user_id');
        $dataChart = $this->chartModel->getAllChartWithMenu($user_id);
        $recommendation = $this->get_recommendations($user_id);
        $ratings = $this->reviewModel->countMenusWithRating();
        $data = [
            'title' => 'Halaman Utama | Foodie Fiend',
            'hero_img' => 'https://images.squarespace-cdn.com/content/v1/61709486e77e1d27c181981c/a9eb540d-aff8-4360-8354-1d35c856a561/0223_UrbanSpace_ZeroIrving_LizClayman_160.png',
            'charts' => $dataChart,
            'menus_ratings' => $ratings,
            'menus' => $recommendation,
            'use_chart_button' => false,
            'use_hero_text' => true,
        ];
        return view('pages/recommendation', $data);
    }

    public function rating($rating)
    {
        $user_id = session()->get('user_id');
        $dataChart = $this->chartModel->getAllChartWithMenu($user_id);
        $menus = $this->reviewModel->getMenus($rating);
        $data = [
            'title' => "Menu Rating $rating | Foodie Fiend",
            'charts' => $dataChart,
            'menus' => $menus,
            'use_chart_button' => false,
            'use_hero_text' => true,
        ];
        return view('pages/recommendation_rating', $data);
    }

    public function invokePython()
    {
        $pythonPath = getenv("PYTHON_PATH");
        $command = escapeshellcmd("{$pythonPath} scripts/recommendation.py");
        $output = shell_exec($command);

        return view('pages/recommendation_rating', ['output' => $output]);
    }
}
