<?php

class Homepages extends BaseSql {
    protected $id_homepage = null;
    protected $name;
    protected $description_top_banner;
    protected $description_images;
    protected $description_bottom_banner;
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
     * @return mixed
     */
    public function getDescriptionTopBanner()
    {
        return $this->description_top_banner;
    }

    /**
     * @param mixed $description_top_banner
     */
    public function setDescriptionTopBanner($description_top_banner)
    {
        $this->description_top_banner = $description_top_banner;
    }

    /**
     * @return mixed
     */
    public function getDescriptionImages()
    {
        return $this->description_images;
    }

    /**
     * @param mixed $description_top_banner
     */
    public function setDescriptionImages($description_images)
    {
        $this->description_images = $description_images;
    }

    /**
     * @return mixed
     */
    public function getDescriptionBottomBanner()
    {
        return $this->description_bottom_banner;
    }

    /**
     * @param mixed $description_bottom_banner
     */
    public function setDescriptionBottomBanner($description_bottom_banner)
    {
        $this->description_bottom_banner = $description_bottom_banner;
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

    public function homePageForm($sTitle = "")
    {
        return [
            "config" => ["method" => "POST", "action" => "", "class" => "form col-md-5 row", "enctype" => "multipart/form-data", "submit" => "Enregistrer une page d'accueil", "pageTitle" => $sTitle],
            "input" => [
                "name" => [
                    "title" => "Nom de la page à créer",
                    "type" => "text",
                    "placeholder" => "Ajouter un nom",
                ],
                "description_top_banner" => [
                    "title" => "Titre pour la bannière du haut",
                    "type" => "text",
                    "placeholder" => "Ajouter un titre",
                ],
                "description_images" => [
                    "title" => "Titre pour les deux images",
                    "type" => "text",
                    "placeholder" => "Ajouter une description",
                ],
                "description_bottom_banner" => [
                    "title" => "Titre pour la bannière du bas",
                    "type" => "text",
                    "placeholder" => "Ajouter une description",
                ],
                "banner" => [
                    "title" => "Upload l'image bannière du haut",
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
                    "title" => "Upload l'image bannière du bas",
                    "type" => "file",
                    "placeholder" => "Ajouter une image",
                ]
            ]
        ];
    }

}