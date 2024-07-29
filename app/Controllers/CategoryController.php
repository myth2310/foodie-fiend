<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\CategoryEntity;
use App\Models\CategoryModel;
use CodeIgniter\HTTP\ResponseInterface;

class CategoryController extends BaseController
{

    protected $category;
    protected $categoryModel;

    public function __construct()
    {
        $this->category = new CategoryEntity();
        $this->categoryModel = new CategoryModel();
    }

    public function getAllByStoreId($store_id)
    {
        $categories = $this->categoryModel->where('store_id', $store_id)->findAll();
        $totalCategory = count($categories);
        $data = [
            'categories' => $categories,
            'totalCategory' => $totalCategory,
        ];

        return $data;
    }

    public function index()
    {
        $categories = $this->categoryModel->findAll();
        $totalCategory = count($categories);
        $data = [
            'categories' => $categories,
            'totalCategory' => $totalCategory,
        ];

        return $data;
    }

    public function edit($category_id)
    {
        $data = $this->categoryModel->find($category_id);
        return view('pages/category_edit', ['data' => $data]);
    }

    public function add()
    {
        $this->category->name = $this->request->getPost('name');
        $this->category->description = $this->request->getPost('description');
        $this->category->store_id = session()->get('store_id')->id;

        if (!$this->categoryModel->save($this->category)) {
            return redirect()->back()->withInput()->with('errors', $this->categoryModel->errors());
        }

        session()->setFlashdata('messages', ['Berhasil tambah kategori']);
        return redirect()->back();
    }

    public function update($category_id)
    {
        $this->category->name = $this->request->getPost('name');
        $this->category->description = $this->request->getPost('description');

        if (!$this->categoryModel->update($category_id, $this->category)) {
            return redirect()->back()->withInput()->with('errors', $this->categoryModel->errors());
        }

        return redirect()->to('/dashboard/category')->with('messages', ['Berhasil update kategori']);
    }

    public function get()
    {
        $store = session()->get('store_id');
        if (!$store) {
            return redirect()->to('/')->with('errors', ['Login dulu']);
        }
        $data = $this->categoryModel->where('store_id', $store->id)->findAll();
        return $this->response->setJSON(['data' => $data]);
    }

    public function getByStoreId($store_id)
    {
        return $this->categoryModel->where('store_id', $store_id)->findAll();
    }

    public function delete($id)
    {
        $session = session();

        if (!$this->categoryModel->find($id)) {
            $session->setFlashdata('errors', [
                'Gagal menghapus kategori',
                'Kategori tidak ditemukan',
            ]);
            return redirect()->back();
        }

        if (!$this->categoryModel->delete($id)) {
            $session->setFlashdata('errors', [
                'Gagal menghapus kategori',
            ]);
            return redirect()->back();
        }

        $session->setFlashdata('messages', ['Berhasil menghapus kategori']);
        return redirect()->back();
    }
}
