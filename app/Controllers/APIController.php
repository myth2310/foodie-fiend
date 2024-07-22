<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\StoreModel;
use CodeIgniter\HTTP\ResponseInterface;

class APIController extends BaseController
{
    protected $menuModel;
    protected $storeModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
        $this->storeModel = new StoreModel();
    }

    public function index()
    {
    }

    public function createStore()
    {
        
    }
}
