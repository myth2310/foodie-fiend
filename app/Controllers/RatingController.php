<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MenuModel;
use App\Models\ReviewModel;

class RatingController extends BaseController
{
    protected $menuModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
    }

    public function review()
    {
        $reviewModel = new ReviewModel();
        $session = session(); 
    
        $userId = $session->get('user_id'); 
        $menuId = $this->request->getPost('menu_id'); 
        $rating = $this->request->getPost('rating');
        $review = $this->request->getPost('ulasan');
    
        $data = [
            'user_id' => $userId,
            'menu_id' => $menuId,
            'rating' => $rating,
            'review' => $review,
        ];
    
        if ($reviewModel->insert($data)) {
            $session->setFlashdata('success', 'Rating berhasil dikirim. Terima kasih atas masukan Anda!');
            return redirect()->to('/user/dashboard/order');
        } else {
            return redirect()->back()->withInput()->with('errors', $reviewModel->errors());
        }
    }
    


    public function getProductData($menu_id)
    {
        $product = $this->menuModel->find($menu_id);
        return view('pages/user/ratings', ['product' => $product]);

    }
}
