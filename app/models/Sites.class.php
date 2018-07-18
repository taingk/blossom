<?php

class Sites extends BaseSql {
    protected $id_site = null;
    protected $name;
    protected $logo;
    protected $favicon;
    protected $main_color;
    protected $secondary_color;
    protected $third_color;
    protected $is_use;
    protected $status;

    public function __construct() {
        // On instancie le parent
        parent::__construct();
    }

    public function getId()
    {
        return $this->id_site;
    }

    public function setId( $id_site )
    {
        $this->id_site = $id_site;
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
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }
    /**
     * @return mixed
     */
    public function getFavicon()
    {
        return $this->favicon;
    }

    /**
     * @param mixed $favicon
     */
    public function setFavicon($favicon)
    {
        $this->favicon = $favicon;
    }
    /**
     * @return mixed
     */
    public function getMainColor()
    {
        return $this->main_color;
    }

    /**
     * @param mixed $main_color
     */
    public function setMainColor($main_color)
    {
        $this->main_color = $main_color;
    }
    /**
     * @return mixed
     */
    public function getSecondaryColor()
    {
        return $this->secondary_color;
    }

    /**
     * @param mixed $main_color
     */
    public function setSecondaryColor($secondary_color)
    {
        $this->secondary_color = $secondary_color;
    }
    /**
     * @return mixed
     */
    public function getThirdColor()
    {
        return $this->third_color;
    }

    /**
     * @param mixed $third_color
     */
    public function setThirdColor($third_color)
    {
        $this->third_color = $third_color;
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

    public function sitesForm()
    {
        return [
            "config" => ["method" => "POST", "action" => "", "class" => "form col-md-4", "enctype" => "multipart/form-data", "submit" => "Enregistrer l'identité du site", "pageTitle" => "Ajouter une identité pour le site"],
            "input" => [
                "name" => [
                    "title" => "Nom de votre site",
                    "type" => "text",
                    "placeholder" => "Ajouter un nom",
                ],
                "logo" => [
                    "title" => "Ajouter un logo",
                    "type" => "file"
                ],
                "favicon" => [
                    "title" => "Ajouter une favicon",
                    "type" => "file"
                ],
                "main_color" => [
                    "title" => "Couleur principale",
                    "type" => "text",
                    "placeholder" => "Ajouter une couleur en hexadécimale, ex : #D8475D",
                ],
                "secondary_color" => [
                    "title" => "Seconde couleur",
                    "type" => "text",
                    "placeholder" => "Ajouter une couleur en hexadécimale, ex : #FDFBFB",
                ],
                "third_color" => [
                    "title" => "Troisième couleur",
                    "type" => "text",
                    "placeholder" => "Ajouter une couleur en hexadécimale, ex : #363636",
                ]
            ]
        ];
    }
}

?>