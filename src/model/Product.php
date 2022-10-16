<?php

class Product 
{
    private $id;
    private $name;
    private $color;
    private $price;

    public function __constructor() {
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getColor() {
        return $this->color;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function setName($name) {
        $this->name = $name;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function setPrice($price) {
        $this->price = $price;
    }
}