<?php

class Images extends BaseSql {
    protected $id_image = null;
    protected $image_name;
    protected $path;
    protected $products_idproduct;
    protected $status;

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

    public function __construct() {
        // On instancie le parent 
        parent::__construct();
    }

    public function setId($id) {
        $this->id_image = trim($id);
    }

    public function setImageName($image_name) {
        $this->image_name = strip_tags(trim($image_name));
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

    public function imageForm($sTitle = "", $aProducts) {
        return [
            "config" => [ "method" => "POST", "action" => "", "submit" => "Enregistrer une image", "enctype" => "multipart/form-data", "class" => "form col-md-5 row", "pageTitle" => $sTitle],
            "input" => [
                "product" =>       [
                    "title" => "Produit",
                    "type" => "select",
                    "options" => $aProducts,
                    "required" => true,
                ],
                "image_name" =>       [
                    "title" => "Nom de votre image",
                    "type" => "text",
                    "required" => true,
                ],
                "image" =>      [
                    "title" => "Upload ton image",
                    "type" => "file",
                    "placeholder" => "Ajoutez une image",
                ]

            ]
        ];
    }
}

?>