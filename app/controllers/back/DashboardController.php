<?php
namespace App\Controllers\Back;

use App\Core\Controller;
use App\Models\Order;
use App\Models\Cake;
use App\Models\User;

class DashboardController extends Controller {
    private $orderModel;
    private $cakeModel;
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->orderModel = new Order();
        $this->cakeModel = new Cake();
        $this->userModel = new User();
    }

    public function index() {
        $stats = [
            'total_orders' => $this->orderModel->getTotalOrders(),
            'recent_orders' => $this->orderModel->getRecentOrders(),
            'top_selling_cakes' => $this->cakeModel->getTopSelling(),
            'total_revenue' => $this->orderModel->getTotalRevenue(),
            'new_customers' => $this->userModel->getNewCustomers()
        ];

        $this->render('back/dashboard', $stats);
    }

    public function analytics() {
        $data = [
            'monthly_sales' => $this->orderModel->getMonthlySales(),
            'category_performance' => $this->cakeModel->getCategoryPerformance()
        ];

        $this->render('back/analytics', $data);
    }
}
