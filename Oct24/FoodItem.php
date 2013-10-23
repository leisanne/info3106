<?php
class FoodItem {
    private $upc;
    private $description;
    private $price;
    
    function __construct($upc, $description, $price) {
        $this->upc = $upc;
        $this->description = $description;
        $this->price = $price;
    }

    public function edit($foodItem) {
        $this->upc = $foodItem->getUpc();
        $this->description = $foodItem->getDescription();
        $this->price = $foodItem->getPrice();
    }
    
    // GETTERS/SETTERS
    
    public function getUpc() {
        return $this->upc;
    }

    public function setUpc($upc) {
        $this->upc = $upc;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }
}
?>
