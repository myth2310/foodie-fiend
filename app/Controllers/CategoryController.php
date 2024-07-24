<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\CategoryEntity;
use App\Models\CategoryModel;
use CodeIgniter\HTTP\ResponseInterface;

class CategoryController extends BaseController
{
    public function index()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->findAll();
        $totalCategory = count($categories);
        $data = [
            'categories' => $categories,
            'totalCategory' => $totalCategory,
        ];

        return $data;
    }

    public function add()
    {
        $categoryModel = new CategoryModel();
        $category = new CategoryEntity();

        $category->name = $this->request->getPost('name');
        $category->description = $this->request->getPost('description');

        if (!$categoryModel->save($category)) {
            return redirect()->back()->withInput()->with('errors', $categoryModel->errors());
        }
        return $this->response->setJSON(['status' => 'success']);
    }

    // public function get($store_id)
    // {
    //     $categoryModel = new CategoryModel();
    //     return $categoryModel->where('store_id', $store_id)->findAll();
    // }

    public function get($store_id)
    {
        $categoryModel = new CategoryModel();
        $data = $categoryModel->where('store_id', $store_id)->findAll();
        return $this->response->setJSON(['data' => $data]);
    }

    public function delete($id)
    {
        $categoryModel = new CategoryModel();
        $session = session();

        if (!$categoryModel->find($id)) {
            $session->setFlashdata('errors', [
                'Gagal menghapus kategori',
                'Kategori tidak ditemukan',
            ]);
            return redirect()->back();
        }

        if (!$categoryModel->delete($id)) {
            $session->setFlashdata('errors', [
                'Gagal menghapus kategori',
            ]);
            return redirect()->back();
        }
        $session->setFlashdata('messages', ['Berhasil menghapus kategori']);
        return redirect()->back();
    }
}
