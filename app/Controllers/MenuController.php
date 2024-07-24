<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\MenuEntity;
use App\Helpers\CloudinaryHelper;
use App\Models\MenuModel;
use App\Models\StoreModel;
use App\Models\UserModel;

class MenuController extends BaseController
{
    public function index()
    {
        $menuModel = new MenuModel();
        $menus = $menuModel->findAll();
        $totalMenus = count($menus);
        $data = [
            'menus' => $menus,
            'totaMenus' => $totalMenus,
        ];

        return $data;
    }

    public function detail($menu_id)
    {
        $menuModel = new MenuModel();
        // $menu = $menuModel->find($menu_id);
        $menu = $menuModel->getMenuWithStore($menu_id);

        return view('pages/menu_detail', ['data' => $menu]);
    }

    public function create()
    {
        $menuModel = new MenuModel();
        $storeModel = new StoreModel();
        $menu = new MenuEntity();

        $user_id = session()->get("id");
        $store = $storeModel->where('user_id', $user_id)->first();
        $menu->store_id = $store->id;
        $menu->name = $this->request->getPost('menu_name');
        $menu->price = $this->request->getPost('menu_price');
        $menu->category = $this->request->getPost('menu_category');
        $menu->description = $this->request->getPost('menu_description');
        $file = $this->request->getFile('file');

        if ($file->isValid() && !$file->hasMoved()) {
            // Path sementara file
            $filePath = $file->getTempName();

            // Upload file ke Cloudinary
            $uploadHelper = new CloudinaryHelper();
            $uploadResult = $uploadHelper->upload($filePath);
            // $uploadResult = (new UploadApi())->upload($filePath);
            // Mendapatkan URL file yang diupload
            $menu->image_url = $uploadResult['secure_url'];
        }
            
        if (!$menuModel->save($menu)) {
                session()->setFlashdata('errors', $menuModel->errors());
                return redirect()->back();
        }

        session()->setFlashdata('messages', ['Sukses tambah data']);
        return redirect()->back();
    }

    public function getAll($store_id)
    {
        $menuModel = new MenuModel();
        return $menuModel->where('store_id', $store_id)->findAll();
    }
}
