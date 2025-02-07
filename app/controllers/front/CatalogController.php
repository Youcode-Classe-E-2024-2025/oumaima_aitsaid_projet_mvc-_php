<?php
namespace App\Controllers\Front;

use App\Core\Controller;
use App\Models\Cake;
use App\Models\Category;

class CatalogController extends Controller {
    private $cakeModel;
    private $categoryModel;

    public function __construct() {
        parent::__construct();
        $this->cakeModel = new Cake();
        $this->categoryModel = new Category();
    }

    public function index() {
        $data = [
            'categories' => $this->categoryModel->getAllCategories(),
            'cakes' => $this->cakeModel->getAllCakes(),
            'featured' => $this->cakeModel->getFeaturedCakes()
        ];

        $this->render('front/catalog/index', $data);
    }

    public function category($id) {
        $data = [
            'category' => $this->categoryModel->findById($id),
            'cakes' => $this->cakeModel->getCakesByCategory($id)
        ];

        $this->render('front/catalog/category', $data);
    }
}

