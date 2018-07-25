<?php

class Cgvs extends BaseSql {
    protected $id_cgv = null;
    protected $name;
    protected $title;
    protected $details;
    protected $is_use;
    protected $status;

    public function __construct() {
        // On instancie le parent
        parent::__construct();
    }

    public function getId()
    {
        return $this->id_cgv;
    }

    public function setId( $id_cgv )
    {
        $this->id_cgv = $id_cgv;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = strip_tags(trim($name));
    }
    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = strip_tags(trim($title));
    }
    /**
     * @return mixed
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param mixed $details
     */
    public function setDetails($details)
    {
        $this->details = strip_tags(trim($details));
    }

    /**
     * @return mixed
     */
    public function getIsUse()
    {
        return $this->is_use;
    }

    /**
     * @param mixed $is_use
     */
    public function setIsUse($is_use)
    {
        $this->is_use = $is_use;
    }

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

    public function cgvsForm($sTitle = "")
    {
        return [
            "config" => ["method" => "POST", "action" => "", "class" => "form col-md-5 row", "submit" => "Enregistrer les conditions générales de vente", "pageTitle" => $sTitle],
            "input" => [
                "name" => [
                    "title" => "Nom de la page à créer",
                    "type" => "text",
                    "placeholder" => "Ajouter un nom",
                ],
                "title" => [
                    "title" => "Titre des conditions générales de vente",
                    "type" => "text",
                    "placeholder" => "Ajouter un titre",
                ],
                "details" => [
                    "title" => "Description des conditions générales de vente",
                    "type" => "text",
                    "placeholder" => "Ajouter une description",
                ]
            ]
        ];
    }
}

?>