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

    public function index()
    {
        $user_id = session()->get('user_id');
        $dataChart = $this->chartModel->getAllChartWithMenu($user_id);
        $recommendation = $this->recommend_python(session()->get('user_id'));
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

    private function recommend_python($user_id)
    {
        $user_id = null;
        // path ke script python
        $pythonScriptPath = APPPATH . '../scripts/python/recommendation.py';

        // menjalankan script python dengan user_id sebagai parameter
        $pythonEnv = getenv("PYTHON_PATH");
        $command = escapeshellcmd("$pythonEnv $pythonScriptPath $user_id");
        $output = shell_exec($command);
 
        // memisahkan hasil output dari script python
        $json_string = str_replace("'", '"', $output);
        $recommendedMenuIds = json_decode($json_string, true);
 
        $menus = $this->menuModel->whereIn('id', $recommendedMenuIds)->findAll();

        // menampilkan hasil rekomendasi
        return $menus;
    }

    public function rating($ratting)
    {
        $user_id = session()->get('user_id');
        $dataChart = $this->chartModel->getAllChartWithMenu($user_id);
        $data = [
            'title' => 'Halaman Utama | Foodie Fiend',
            'hero_img' => 'https://images.squarespace-cdn.com/content/v1/61709486e77e1d27c181981c/a9eb540d-aff8-4360-8354-1d35c856a561/0223_UrbanSpace_ZeroIrving_LizClayman_160.png',
            'charts' => $dataChart,
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
