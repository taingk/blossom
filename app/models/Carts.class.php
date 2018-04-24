<?php

class Carts extends BaseSql {
    protected $id_cart = null;
    protected $capacities_id_capacity;
    protected $products_id_product;
    protected $colors_id_color;
    protected $users_id_user;
    protected $orders_id_order;
    protected $status;

    public function __construct() {
        // On instancie le parent 
        parent::__construct();
    }

    public function setId($id) {
        $this->id_cart = trim($id);
    }

    /**
     * @return mixed
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus( $status ) {
        $this->status = $status;
    }

    public function setCapacitiesIdCapacity($capacities_id_capacity) {
        $this->capacities_id_capacity = trim($capacities_id_capacity);
    }

    public function setProductsIdProduct($products_id_product) {
        $this->products_id_product = trim($products_id_product);
    }

    public function setColorsIdColor($colors_id_color) {
        $this->colors_id_color = trim($colors_id_color);
    }

    public function setUsersIdUser($users_id_user) {
        $this->users_id_user = trim($users_id_user);
    }
    
    public function setOrdersIdOrder($orders_id_order) {
        $this->orders_id_order = trim($orders_id_order);
    }

    public function getIdCart()
    {
        return $this->id_cart;
    }

    public function getCapacitiesIdCapacity()
    {
        return $this->capacities_id_capacity;
    }

    public function getProductsIdProduct()
    {
        return $this->products_id_product;
    }

    public function getColorsIdColor()
    {
        return $this->colors_id_color;
    }

    public function getUsersIdUser()
    {
        return $this->users_id_user;
    }

    public function getOrdersIdOrder()
    {
        return $this->orders_id_order;
    }

}

?>