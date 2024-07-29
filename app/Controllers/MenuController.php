<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\MenuEntity;
use App\Helpers\CloudinaryHelper;
use App\Models\ChartModel;
use App\Models\MenuModel;
use App\Models\StoreModel;

class MenuController extends BaseController
{
    protected $menu;
    protected $menuModel;
    protected $storeModel;
    protected $chartModel;

    protected $uploadHelper;

    public function __construct()
    {
        $this->menu = new MenuEntity();
        $this->menuModel = new MenuModel();
        $this->storeModel = new StoreModel();
        $this->chartModel = new ChartModel();
        $this->uploadHelper = new CloudinaryHelper();
    }

    public function getAllByStoreId($store_id)
    {
        $menus = $this->menuModel->where('store_id', $store_id)->findAll();
        $total_menu = count($menus);
        $data = [
            'menus' => $menus,
            'totalMenu' => $total_menu,
        ];
        return $data;
    }

    public function index()
    {
        $menus = $this->menuModel->findAll();
        $totalMenu = count($menus);
        $data = [
            'menus' => $menus,
            'totalMenu' => $totalMenu,
        ];

        return $data;
    }

    public function detail($menu_id)
    {
        $user_id = session()->get('user_id');
        $menu = $this->menuModel->getMenuWithStore($menu_id);
        $charts = $this->chartModel->getAllChartWithMenu($user_id);
        $data = [
            'data' => $menu,
            'charts' => $charts,
        ];

        return view('pages/menu_detail', $data);
    }

    public function create()
    {
        $user_id = session()->get("id");
        $store = $this->storeModel->where('user_id', $user_id)->first();
        $this->menu->store_id = session()->get('store_id');
        $this->menu->name = $this->request->getPost('menu_name');
        $this->menu->price = $this->request->getPost('menu_price');
        $this->menu->category = $this->request->getPost('menu_category');
        $this->menu->description = $this->request->getPost('menu_description');
        $file = $this->request->getFile('file');

        if ($file->isValid() && !$file->hasMoved()) {
            // Path sementara file
            $filePath = $file->getTempName();

            // Upload file ke Cloudinary
             $uploadResult = $this->uploadHelper->upload($filePath);
            // $uploadResult = (new UploadApi())->upload($filePath);
            // Mendapatkan URL file yang diupload
            $this->menu->image_url = $uploadResult['secure_url'];
        }
            
        if (!$this->menuModel->save($this->menu)) {
                session()->setFlashdata('errors', $this->menuModel->errors());
                return redirect()->back();
        }

        session()->setFlashdata('messages', ['Sukses tambah data']);
        return redirect()->back();
    }

    public function getAll($store_id)
    {
        return $this->menuModel->where('store_id', $store_id)->findAll();
    }
}
