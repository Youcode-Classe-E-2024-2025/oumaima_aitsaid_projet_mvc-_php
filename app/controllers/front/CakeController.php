<?php
namespace App\Controllers\Front;

use App\Core\Database;

class CakeController {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function index() {
        // Get categories from database
        $stmt = $this->db->query("SELECT * FROM categories");
        $categories = $stmt->fetchAll();

        // Get featured cakes from database
        $stmt = $this->db->query("SELECT * FROM cakes WHERE featured = true");
        $featuredCakes = $stmt->fetchAll();

        // Pass data to view
        require_once __DIR__ . '/../../../app/views/front/cakes/index.php';
    }
}

