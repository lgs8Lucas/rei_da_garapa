<?php
class SalesModel {
    private $id;
    private $productId;
    private $quantity;
    private $saleDate;

    public function __construct($productId, $saleDate) {
        $this->productId = $productId;
        $this->saleDate = $saleDate;
    }

    public function getId() { 
        return $this->id; 
    }
    public function getProductId() {
         return $this->productId; 
        }
    public function getSaleDate() { 
        return $this->saleDate; 
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function setProductId($productId) {
        $this->productId = $productId;
    }
    
    
    public function setSaleDate($saleDate) {
        $this->saleDate = $saleDate;
    }


    
}