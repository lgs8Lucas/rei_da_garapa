<?php
require_once './../models/salesModel.php';

class SalesDAO
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    public function insert(SalesModel $sale)
    {
        $sql = "INSERT INTO Sales (Product_ID) VALUES (?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$sale->getProductId()]);
    }


    public function getAll()
    {
        $sql = "SELECT * FROM Sales";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sales = [];
        foreach ($rows as $row) {
            $sale = new SalesModel($row['Product_ID']);
            $sale->setId($row['Sale_ID']);
            $sale->setSaleDate($row['Sale_Time']);
            $sales[] = $sale;
        }

        return $sales;
    }
}
