<?php

class Legalnotices extends BaseSql {
    protected $id_legal_notices = null;
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
        return $this->id_legal_notices;
    }

    public function setId( $id_legal_notices )
    {
        $this->id_legal_notices = $id_legal_notices;
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
        $this->name = $name;
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
        $this->title = $title;
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
        $this->details = $details;
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

    public function legalNoticesForm()
    {
        return [
            "config" => ["method" => "POST", "action" => "", "class" => "form col-md-4", "submit" => "Enregistrer les mentions légales", "pageTitle" => "Ajouter des mentions légales"],
            "input" => [
                "name" => [
                    "title" => "Nom de la page à créer",
                    "type" => "text",
                    "placeholder" => "Ajouter un nom",
                ],
                "title" => [
                    "title" => "Titre des mentions légales",
                    "type" => "text",
                    "placeholder" => "Ajouter un titre",
                ],
                "details" => [
                    "title" => "Description des mentions légales",
                    "type" => "text",
                    "placeholder" => "Ajouter une description",
                ]
            ]
        ];
    }
}

?>