<?php

class Catergories extends BaseSql {
    protected $id_categorie = null;
    protected $category_name;

    public function __construct() {
        // On instancie le parent 
        parent::__construct();
    }

    public function setId($id) {
        $this->id_categorie = trim($id);
    }

    public function setCategoryName($category_name) {
        $this->category_name = trim($category_name);
    }

    public function getIdCategorie()
    {
        return $this->id_categorie;
    }

    public function getCategoryName()
    {
        return $this->category_name;
    }
}
?>