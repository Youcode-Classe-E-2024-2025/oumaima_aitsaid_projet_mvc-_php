<?php
namespace App\Models;

use App\Core\Model;
use PDO;

class Category extends Model {
    protected $table = 'categories';

    public function getAllCategories() {
        $query = "SELECT * FROM {$this->table} ORDER BY name ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
