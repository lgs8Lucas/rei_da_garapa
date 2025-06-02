<?php

require_once '../dao/SalesDAO.php';
require_once '../models/SalesModel.php';

class SalesController {
    private $dao;

    public function __construct($pdo) {
        $this->dao = new SalesDAO($pdo);
    }

    // Registrar uma nova venda
    public function createSale($productId, $saleDate = null) {
        if (!$saleDate) {
            $saleDate = date('Y-m-d H:i:s'); 
        }

        $sale = new SalesModel($productId, $saleDate);

        return $this->dao->insert($sale);
    }

    // Listar todas as vendas
    public function listSales() {
        return $this->dao->getAll();
    }


}