<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MenuModel;
use CodeIgniter\HTTP\ResponseInterface;

class RecommendationController extends BaseController
{
    protected $menuModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
    }

    public function index()
    {
        return view('pages/recommendation', ['data' => []]);
    }

    public function rating($ratting)
    {
        return view('pages/recommendation_ratting', ['data' => []]);
    }

    private function getCategories($menus)
    {
        $categories = array_unique(array_column($menus, 'category'));
        return array_values($categories);
    }

    private function encodeCategory($category, $categories)
    {
        return array_search($category, $categories);
    }

    private function euclideanDistance($menu1, $menu2)
    {
        return sqrt(
            pow($menu1['price'] - $menu2['price'], 2) +
            pow($menu1['category_encoded'] - $menu2['category_encoded'], 2)
        );
    }

    private function getNearestMenu($menus, $targetMenu, $k)
    {
        $distances = [];

        foreach ($menus as $menu) {
            if ($menu['id'] !== $targetMenu['id']) {
                $distance = $this->euclideanDistance($targetMenu, $menus);
                $distances[$menu['id']] = $distance;
            }
        }

        asort($distances);
        return array_slice(array_keys($distances), 0, $k, true);
    }

    private function recommendMenus($menus, $targetMenu, $k)
    {
        $nearestMenus = $this->getNearestMenu($menus, $targetMenu, $k);
        $recommendations = [];

        foreach ($nearestMenus as $menuId) {
        }
    }
}
