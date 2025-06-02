<?php
require_once './../models/salesModel.php';

class SalesDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }


    public function insert(SalesModel $sale) {
        $sql = "INSERT INTO Sales (Product_ID, Sale_Time) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $sale->getProductId(),
            $sale->getSaleDate()
        ]);
    }


    public function getAll() {
        $sql = "SELECT * FROM Sales";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sales = [];
        foreach ($rows as $row) {
            $sales[] = new SalesModel(          
                $row['Product_ID'],
                $row['Sale_Time']
            );
        }

        return $sales;
    }


}
