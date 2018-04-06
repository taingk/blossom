<?php

class Colors extends BaseSql {
    protected $id_color = null;
    protected $color_hexa;
    protected $products_idproduct;

    public function __construct() {
        // On instancie le parent 
        parent::__construct();
    }

    public function setId($id) {
        $this->id_color = trim($id);
    }

    public function setColorHexa($color_hexa) {
        $this->color_hexa = trim($color_hexa);
    }

    public function setProductsIdProduct($products_idproduct) {
        $this->products_idproduct = trim($products_idproduct);
    }
}
?>