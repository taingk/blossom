<?php

class Categories extends BaseSql {
    protected $id_category = null;
    protected $category_name;
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
        $this->id_category = trim($id);
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