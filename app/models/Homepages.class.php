<?php

class Homepages extends BaseSql {
    protected $id_homepage = null;
    protected $name;
    protected $type;
    protected $title_page;
    protected $description_page;
    protected $banner;
    protected $left_image;
    protected $right_image;
    protected $bottom_banner;
    protected $is_use;
    protected $status;

    public function __construct() {
        // On instancie le parent
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
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
    public function getisUse()
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

    public function getId() {
        return $this->id_homepage;
    }

    public function setId($id) {
        $this->id_homepage = trim($id);
    }

    /**
     * @return null
     */
    public function getIdHomepage()
    {
        return $this->id_homepage;
    }

    /**
     * @param null $id_homepage
     */
    public function setIdHomepage($id_homepage)
    {
        $this->id_homepage = $id_homepage;
    }

    /**
     * @return mixed
     */
    public function getTitlePage()
    {
        return $this->title_page;
    }

    /**
     * @param mixed $title_page
     */
    public function setTitlePage($title_page)
    {
        $this->title_page = $title_page;
    }

    /**
     * @return mixed
     */
    public function getDescriptionPage()
    {
        return $this->description_page;
    }

    /**
     * @param mixed $description_page
     */
    public function setDescriptionPage($description_page)
    {
        $this->description_page = $description_page;
    }

    /**
     * @return mixed
     */
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * @param mixed $banner
     */
    public function setBanner($banner)
    {
        $this->banner = $banner;
    }

    /**
     * @return mixed
     */
    public function getLeftImage()
    {
        return $this->left_image;
    }

    /**
     * @param mixed $left_image
     */
    public function setLeftImage($left_image)
    {
        $this->left_image = $left_image;
    }

    /**
     * @return mixed
     */
    public function getRightImage()
    {
        return $this->right_image;
    }

    /**
     * @param mixed $right_image
     */
    public function setRightImage($right_image)
    {
        $this->right_image = $right_image;
    }

    /**
     * @return mixed
     */
    public function getBottomBanner()
    {
        return $this->bottom_banner;
    }

    /**
     * @param mixed $bottom_banner
     */
    public function setBottomBanner($bottom_banner)
    {
        $this->bottom_banner = $bottom_banner;
    }

    public function editorForm()
    {
        return [
            "config" => ["method" => "POST", "action" => "", "class" => "form col-md-4", "enctype" => "multipart/form-data", "submit" => "Enregistrer une page d'accueil", "pageTitle" => "Ajouter une nouvelle page d'accueil"],
            "input" => [
                "name" => [
                    "title" => "Nom de la page",
                    "type" => "text",
                    "placeholder" => "Ajouter un nom",
                ],
                "title_page" => [
                    "title" => "Phrase d'accroche",
                    "type" => "text",
                    "placeholder" => "Ajouter un titre",
                ],
                "description_page" => [
                    "title" => "Description du site",
                    "type" => "text",
                    "placeholder" => "Ajouter une description",
                ],
                "banner" => [
                    "title" => "Upload l'image bannière",
                    "type" => "file",
                    "placeholder" => "Ajouter une image",
                ],
                "left_image" => [
                    "title" => "Upload l'image gauche",
                    "type" => "file",
                    "placeholder" => "Ajouter une image",
                ],
                "right_image" => [
                    "title" => "Upload l'image droite",
                    "type" => "file",
                    "placeholder" => "Ajouter une image",
                ],
                "bottom_banner" => [
                    "title" => "Upload l'image bannière de bas",
                    "type" => "file",
                    "placeholder" => "Ajouter une image",
                ]
            ]
        ];
    }

}