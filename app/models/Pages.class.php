<?php

class Pages extends BaseSql {
    protected $id_page = null;
    protected $type;
    protected $content;
    protected $in_use;
    protected $status;

    public function __construct() {
        // On instancie le parent 
        parent::__construct();
    }

    public function setIdPage($id) {
        $this->id_page = trim($id);
    }

    public function setType($type) {
        $this->type = trim($type);
    }

    public function setContent($content) {
        $this->content = trim($content);
    }

    public function setInUse($in_use) {
        $this->in_use = trim($in_use);
    }

    public function setStatus($status) {
        $this->status = trim($status);
    }

    public function getIdPage()
    {
        return $this->id_page;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getInUse()
    {
        return $this->in_use;
    }

    public function getStatus()
    {
        return $this->status;
    }
}

?>