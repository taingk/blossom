<?php

class Orders extends BaseSql {
    protected $id_order = null;
    protected $tracking_number;
    protected $status;
    protected $users_idusers;
    protected $product_idproduct;

    public function __construct() {
        // On instancie le parent 
        parent::__construct();
    }

    public function setId($id) {
        $this->id_order = trim($id);
    }

    public function setTrackingNumber($tracking_number) {
        $this->tracking_number = trim($tracking_number);
    }

    public function setStatus($status) {
        $this->status = trim($status);
    }

    public function setUsersIdUsers($users_idusers) {
        $this->users_idusers = trim($users_idusers);
    }

    public function setProductIdProduct($product_idproduct) {
        $this->product_idproduct = trim($product_idproduct);
    }
}

?>