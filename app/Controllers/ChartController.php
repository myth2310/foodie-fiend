<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\ChartEntity;
use App\Models\ChartModel;
use App\Models\MenuModel;
use CodeIgniter\HTTP\ResponseInterface;

class ChartController extends BaseController
{
    protected $chartEntity;
    protected $chartModel;
    protected $menuModel;

    public function __construct()
    {
        $this->chartEntity = new ChartEntity();
        $this->chartModel = new ChartModel();
        $this->menuModel = new MenuModel();
    }

    public function get($user_id)
    {
        return $this->chartModel->where('user_id', $user_id)->findAll();
    }

    // fungsi untuk menambahkan menu ke keranjang belanja
    public function addToChart($menu_id)
    {
        // dd(session()->get('is_verif'));
        $chart = $this->chartEntity;
        $chart->user_id = session()->get('user_id');
        $chart->menu_id = $menu_id;
        $chart->store_id = $this->menuModel->select('store_id')->find($menu_id)->store_id;
        $chart->quantity = $this->request->getPost('quantity');
        if (!$chart->quantity) {
            $chart->quantity = 1;
        }

        if (intval(session()->get('is_verif')) == 0) {
            return redirect()->back()->with('errors', ['Lakukan verfikasi email terlebih dahulu', 'Akun Anda belum terverifikasi']);
        }

        if (!$this->chartModel->save($chart)) {
            return redirect()->back()->with('errors', $this->chartModel->errors());
        }

        return redirect()->back()->with('messages', ['Berhasil ditambahkan ke keranjang']);
    }

    // fungsi untuk menghapus menu dari keranjang
    public function removeFromChart()
    {
        $chart_id = $this->request->getPost('chart_id');
        if(!$this->chartModel->delete($chart_id)) {
            return redirect()->back()->with('errors', $this->chartModel->errors());
        }
        return redirect()->back()->with('messages', ['Berhasil dihapus dari keranjang']);
    }
}
