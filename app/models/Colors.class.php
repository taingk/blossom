<?php

class Colors extends BaseSql {
    protected $id_color = null;
    protected $name;
    protected $color_hexa;
    protected $products_idproduct;

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
    protected $status;

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

    public function getIdColor()
    {
        return $this->id_color;
    }

    public function setName($name) {
        $this->name = strip_tags(trim($name));
    }

    public function getName()
    {
        return $this->name;
    }

    public function getColorHexa()
    {
        return $this->color_hexa;
    }

    public function getProductsIdproduct()
    {
        return $this->products_idproduct;
    }

    public function colorForm($sTitle = "", $aProducts) {
        return [
            "config" => [ "method" => "POST", "action" => "", "submit" => "Enregistrer une couleur", "class" => "form col-md-5 row", "pageTitle" => $sTitle],
            "input" => [
                "product" =>       [
                    "title" => "Produit",
                    "type" => "select",
                    "options" => $aProducts,
                    "required" => true,
                ],
                "name" =>      [
                    "title" => "Nom du de la couleur",
                    "type" => "text",
                    "placeholder" => "Rouge",
                    "required" => true,
                    "minString" => 2
                ],
                "color_hexa" =>      [
                    "title" => "Couleur en hexadécimale",
                    "type" => "text",
                    "placeholder" => "#FF0000",
                    "required" => true,
                    "minString" => 2
                ],
            ]
        ];
    }

}
?>