<?php

class Products extends BaseSql {
    protected $id_product = null;
    protected $product_name;
    protected $categories_idcategory;
    protected $description;
    protected $price;
    protected $ram;

    public function __construct() {
        // On instancie le parent 
        parent::__construct();
    }

    public function setId($id) {
        $this->id_product = trim($id);
    }

    public function setProductName($product_name) {
        $this->product_name = trim($product_name);
    }

    public function setCategoriesIdCategory($categories_idcategory) {
        $this->categories_idcategory = trim($categories_idcategory);
    }

    public function setDescription($description) {
        $this->description = trim($description);
    }

    public function setPrice($price) {
        $this->price = trim($price);
    }

    public function setRam($ram) {
        $this->ram = trim($ram);
    }
}

?>