<?php

class Products extends BaseSql {
    protected $id_product = null;
    protected $product_name;
    protected $categories_idcategory;
    protected $description;
    protected $price;
    protected $ram;
    protected $status;
    protected $quantity;

    /**
     * @return mixed
     */
    public function getStatus() {
        return $this->status;
    }

    public function getQuantity() {
        return $this->quantity;
    }


    /**
     * @param mixed $status
     */
    public function setStatus( $status ) {
        $this->status = $status;
    }

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

    public function setQuantity($quantity) {
        $this->quantity = trim($quantity);
    }

    public function setRam($ram) {
        $this->ram = trim($ram);
    }


    public function getIdProduct()
    {
        return $this->id_product;
    }

    public function getProductName()
    {
        return $this->product_name;
    }

    public function getCategoriesIdcategory()
    {
        return $this->categories_idcategory;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getRam()
    {
        return $this->ram;
    }

    public function productsForm()
    {
        return [
            "config" => ["method" => "POST", "action" => "", "class" => "form col-md-4", "enctype" => "multipart/form-data", "submit" => "Enregistrer un produit", "pageTitle" => "Ajouter un nouveau produit"],
            "input" => [
                "name" => [
                    "title" => "Nom du produit",
                    "type" => "text",
                    "placeholder" => "Ajouter un nom",
                ],
                "description_produit" => [
                    "title" => "Description du produit",
                    "type" => "text",
                    "placeholder" => "Ajouter une description",
                ],
                "prix" => [
                    "title" => "Prix du produit",
                    "type" => "int",
                    "placeholder" => "Ajouter votre prix",
                ],
                "ram" => [
                    "title" => "Capacité",
                    "type" => "int",
                    "placeholder" => "Ex : 16Go",
                ]
            ]
        ];
    }
}

?>