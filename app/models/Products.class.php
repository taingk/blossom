<?php

class Products extends BaseSql {
    protected $id_product = null;
    protected $product_name;
    protected $categories_idcategory;
    protected $description;
    protected $price;
    protected $status;
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
  
    public function productFormAdd() {
        $this->oCategory = new Categories();
        $aArrayTemporaire = [];
        $aCategories = $this->oCategory->select(array('id_category','category_name'));
        foreach($aCategories as $key => $value){
            array_push($aArrayTemporaire, ['id' => $value['id_category'], 'name' => $value['category_name']]);
        }
        return [
            "config" => [ "method" => "POST", "action" => "", "submit" => "Enregistrer un produit", "class" => "form col-md-5 row", "enctype" => "multipart/form-data"],
            "input" => [
                "name" =>      [
                    "title" => "Nom du produit",
                    "type" => "text",
                    "placeholder" => "Iphone X",
                    "required" => true,
                    "minString" => 2
                ],
                "category" =>       [
                    "title" => "Catégories",
                    "type" => "select",
                    "options" => $aArrayTemporaire,
                    "required" => true,
                ],
                "description" =>    [
                    "title" => "Description",
                    "type" => "text",
                    "placeholder" => "Description",
                    "required" => true,
                    "minString" => 2
                ],
                "price" =>        [
                    "title" => "Prix",
                    "type" => "number",
                    "placeholder" => "1000",
                    "required" => true
                ],
                "image" =>      [
                    "title" => "Upload une image",
                    "type" => "file",
                    "placeholder" => "Ajouter une image",
                ],
                "image2" =>      [
                    "title" => "Upload une image",
                    "type" => "file",
                    "placeholder" => "Ajouter une image",
                ],
                "image3" =>      [
                    "title" => "Upload une image",
                    "type" => "file",
                    "placeholder" => "Ajouter une image",
                ],
                "color" =>      [
                    "title" => "Couleur",
                    "type" => "text",
                    "placeholder" => "Rouge:#432G3",
                    "required" => true,
                    "minString" => 2
                ],
                "capacity" =>      [
                    "title" => "Capacité",
                    "type" => "text",
                    "placeholder" => "16:150",
                    "required" => true,
                    "minString" => 2
                ],
                "quantity" =>      [
                    "title" => "Quantité",
                    "type" => "number",
                    "placeholder" => "150",
                    "required" => true
                ]

            ]
        ];
    }
}
?>