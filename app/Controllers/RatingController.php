<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MenuModel;

class RatingController extends BaseController
{
    protected $menuModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
    }


    public function index()
    {
        return view('/pages/user/ratings');
    }

    public function getProductData($menu_id)
    {
        $product = $this->menuModel->find($menu_id);

        if ($product) {
            return $this->response->setJSON($product);
        } else {
            return $this->response->setJSON(['error' => 'Product not found']);
        }
    }
}
