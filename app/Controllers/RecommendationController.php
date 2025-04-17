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
        // $dataChart = $this->chartModel->getAllChartWithMenu($user_id);
        // $recommendation = $this->get_recommendations($user_id);
        $ratings = $this->menuModel->countMenusWithRating();
        $recommended_menus = $this->menuModel->getMenusAll($user_id);
        $charts = $this->chartModel->getAllChartWithMenu($user_id);

        $data = [
            'title' => 'Rekomendasi Kuliner | Foodie Fiend',
            'hero_img' => 'https://images.squarespace-cdn.com/content/v1/61709486e77e1d27c181981c/a9eb540d-aff8-4360-8354-1d35c856a561/0223_UrbanSpace_ZeroIrving_LizClayman_160.png',
            'menus_ratings' => $ratings,
            'menus' => $recommended_menus,
            'charts' => $charts,
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
            'rating' => $rating,
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


    public function search() {
        $user_id = session()->get('user_id'); 
        $search_query = $this->request->getGet('query'); 
        $recommended_menu_ids = $this->menuModel->getRecommendedMenuIds($user_id);

        $all_menus = $this->menuModel->getMenusAll();
        $recommended_menus = array_filter($all_menus, function ($menu) use ($recommended_menu_ids, $search_query) {
            return in_array($menu['id'], $recommended_menu_ids) && 
                   stripos($menu['name'], $search_query) !== false;
        });
        $data['menus'] = $recommended_menus;
        dd($data['menus']);
        return view('pages/search_results', $data);
    }
    
}
