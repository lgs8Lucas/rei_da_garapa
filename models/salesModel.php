<?php
class SalesModel {
    private $id;
    private $productId;
    private $saleDate;

    public function __construct($productId) {
        $this->productId = $productId;
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