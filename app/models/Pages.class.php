<?php

class Pages extends BaseSql {
    protected $id_page = null;
    protected $page_name;
    protected $type;
    protected $content;
    protected $is_use;
    protected $status;


    public function __construct() {
        // On instancie le parent 
        parent::__construct();
    }

    public function setIdPage($id_page) {
        $this->id_page = trim($id_page);
    }

    public function setPageName($page_name) {
        $this->page_name = trim($page_name);
    }

    public function setType($type) {
        $this->type = trim($type);
    }

    public function setContent($content) {
        $this->content = trim($content);
    }

    public function setIsUse($is_use) {
        $this->is_use = trim($is_use);
    }

    public function setStatus($status) {
        $this->status = trim($status);
    }

    public function getIdPage()
    {
        return $this->id_page;
    }

    public function getPageName()
    {
        return $this->page_name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getIsUse()
    {
        return $this->is_use;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
?>