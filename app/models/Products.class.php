<?php

class Products extends BaseSql {
    protected $id_product = null;
    protected $product_name;
    protected $categories_idcategory;
    protected $description;
    protected $price;
    protected $status;
    protected $stat;
    protected $quantity;
    protected $max_quantity;

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

    public function setStat($stat) {
      $this->stat = trim($stat);
    }

    public function setQuantity($quantity) {
        $this->quantity = trim($quantity);
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setMaxQuantity($max_quantity) {
        $this->max_quantity = trim($max_quantity);
    }

    public function getMaxQuantity() {
        return $this->max_quantity;
    }

    public function getId()
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

    public function getStat() {
      return $this->stat;
    }

    /**
     * @param mixed $status
     */
    public function setStatus( $status ) {
        $this->status = $status;
    }
    /**
     * @return mixed
     */
    public function getStatus() {
        return $this->status;
    }

    public function productForm($sTitle = "", $aCategories) {
        return [
            "config" => [ "method" => "POST", "action" => "", "submit" => "Enregistrer un produit", "class" => "form col-md-5 row", "enctype" => "multipart/form-data", "pageTitle" => $sTitle],
            "input" => [
                "category" =>       [
                    "title" => "Catégories",
                    "type" => "select",
                    "options" => $aCategories,
                    "required" => true,
                ],
                "product_name" =>      [
                    "title" => "Nom du produit",
                    "type" => "text",
                    "placeholder" => "Iphone X",
                    "required" => true,
                    "minString" => 2
                ],
                "description" =>    [
                    "title" => "Description",
                    "type" => "text",
                    "placeholder" => "Description",
                    "required" => true,
                    "minString" => 2
                ],
                "price" =>        [
                    "title" => "Prix en euro",
                    "type" => "number",
                    "placeholder" => "1000",
                    "required" => true
                ],
                "quantity" =>      [
                    "title" => "Quantité maximum du stock",
                    "type" => "number",
                    "placeholder" => "150",
                    "required" => true
                ],
            ]
        ];
    }

}
?>
