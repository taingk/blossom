<?php

class Comments extends BaseSql {
    protected $id_comment = null;
    protected $comment;
    protected $users_idusers;
    protected $products_idproduct;

    public function __construct() {
        // On instancie le parent 
        parent::__construct();
    }

    public function setId($id) {
        $this->id_comment = trim($id);
    }

    public function setComment($comment) {
        $this->comment = trim($comment);
    }

    public function setUsersIdUsers($users_idusers) {
        $this->users_idusers = trim($users_idusers);
    }

    public function setProductsIdProduct($products_idproduct) {
        $this->products_idproduct = trim($products_idproduct);
    }
}

?>