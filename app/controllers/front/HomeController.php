<?php
namespace App\Controllers\Front;

use App\Core\Controller;
use App\Models\Cake;
use App\Models\Category;

class HomeController extends Controller {
    private $cakeModel;
    private $categoryModel;

    public function __construct() {
        parent::__construct(); // Add this line to initialize Twig
        $this->cakeModel = new Cake();
        $this->categoryModel = new Category();
    }

    public function index() {
        $categories = $this->categoryModel->findAll();
        $featuredCakes = $this->cakeModel->getFeaturedCakes();

        $this->render('front/home', [
            'categories' => $categories,
            'featuredCakes' => $featuredCakes
        ]);
    }
}
