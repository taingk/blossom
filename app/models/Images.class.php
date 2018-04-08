<?php

class Images extends BaseSql {
    protected $id_image = null;
    protected $image_name;
    protected $path;
    protected $products_idproduct;

    public function __construct() {
        // On instancie le parent 
        parent::__construct();
    }

    public function setId($id) {
        $this->id_image = trim($id);
    }

    public function setImageName($image_name) {
        $this->image_name = trim($image_name);
    }

    public function setPath($path) {
        $this->path = trim($path);
    }

    public function setProductsIdProduct($products_idproduct) {
        $this->products_idproduct = trim($products_idproduct);
    }
}

?>