<?php

class SalesDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // INSERIR venda usando SaleModel
    public function insert(SaleModel $sale) {
        $sql = "INSERT INTO Sales (Product_ID, Sale_Time) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $sale->getProductId(),
            $sale->getTime()
        ]);
    }

    // BUSCAR todas as vendas e retornar lista de SaleModel
    public function getAll() {
        $sql = "SELECT * FROM Sales";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sales = [];
        foreach ($rows as $row) {
            $sales[] = new SaleModel(
                $row['Product_ID'],
                $row['Sale_Time']
            );
        }

        return $sales;
    }
}
