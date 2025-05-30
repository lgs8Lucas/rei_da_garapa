<?php

class SaleModel {
    private $productId;
    private $datatime;

    public function __construct($productId, $time) {
        $this->productId = $productId;
        $this->datatime = $time;
    }

    public function getProductId() {
        return $this->productId;
    }

     public function getTime() {
        return $this->datatime;
    }

    public function setProductId($productId) {
        $this->productId = $productId;
    }

    public function setTime($time) {
        $this->datatime = $time;
    }

}
