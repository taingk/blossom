<?php

class Homepages extends BaseSql {
    protected $id_homepage = null;
    protected $title_page;
    protected $description_page;
    protected $banner;
    protected $left_image;
    protected $right_image;
    protected $bottom_banner;
    protected $id_page;
    protected $status;

    public function __construct() {
        // On instancie le parent
        parent::__construct();
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

    public function getIdPage() {
        return $this->id_page;
    }

    public function setIdPage($id) {
        $this->id_page = trim($id);
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
}