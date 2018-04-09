<?php

class Capacities extends BaseSql {
    protected $id_capacity = null;
    protected $capacity_number;
    protected $products_idproduct;
    protected $additional_price;

    public function __construct() {
        // On instancie le parent 
        parent::__construct();
    }

    public function setId($id) {
        $this->id_capacity = $id;
    }

    public function setCapacityNumber($capacity_number) {
        $this->capacity_number = trim($capacity_number);
    }

    public function setProductsIdProduct($products_id_product) {
        $this->products_id_product = trim($products_id_product);
    }

    public function setAdditionalPrice($additional_price) {
        $this->additional_price = trim($additional_price);
    }

    public function getId_capacity()
    {
        return $this->id_capacity;
    }

    public function getCapacityNumber()
    {
        return $this->capacity_number;
    }

    public function getProductsIdproduct()
    {
        return $this->products_idproduct;
    }

    public function getAdditionalPrice()
    {
        return $this->additional_price;
    }
}

?>