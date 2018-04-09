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

    public function getIdImage()
    {
        return $this->id_image;
    }

    public function getImageName()
    {
        return $this->image_name;
    }


    public function getPath()
    {
        return $this->path;
    }

    public function getProductsIdproduct()
    {
        return $this->products_idproduct;
    }
}

?>