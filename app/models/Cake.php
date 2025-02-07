<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class Cake extends Model {
    protected $table = 'cakes';

    public function getAllCakes() {
        $sql = "SELECT c.*, cat.name as category_name 
                FROM {$this->table} c 
                JOIN categories cat ON c.category_id = cat.id 
                ORDER BY c.created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFeaturedCakes() {
        $sql = "SELECT c.*, cat.name as category_name 
                FROM {$this->table} c 
                JOIN categories cat ON c.category_id = cat.id 
                LIMIT 6";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCakesByCategory($categoryId) {
        $sql = "SELECT * FROM {$this->table} WHERE category_id = :category_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['category_id' => $categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
