<?php

class ProductsModel {
    private $id;
    private $name;
    private $quantity;
    private $price;
    private $image;
    private $description;

    public function __construct($name, $quantity, $price, $image, $description) {
        $this->name= $name;
        $this->quantity = $quantity;
        $this->price= $price;
        $this->image = $image;
        $this->description = $description;
    }

     public function getId() {
        return $this->id;
    }

    public function getName() { 
        return $this->name; 
    }

    public function getQuantity() {
         return $this->quantity; 
        }

    public function getPrice() {
         return $this->price; 
        }

    public function getImage() { 
        return $this->image; 
    }

    public function getDescription() {
         return $this->description; 
        }

        
    public function setName($name) {
         $this->name = $name; 
        }
    public function setQuantity($quantity) { 
        $this->quantity = $quantity; 
    }
    public function setPrice($price) {
         $this->price = $price; }

    public function setImage($image) {
         $this->image = $image; 
        }
    public function setDescription($description) {
         $this->description = $description; 
        }
}
