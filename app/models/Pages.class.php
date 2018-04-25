<?php

class Pages extends BaseSql {
    protected $id_page = null;
    protected $name;
    protected $type;
    protected $content;
    protected $is_use;
    protected $status;


    public function __construct() {
        // On instancie le parent 
        parent::__construct();
    }

    public function setId($id_page) {
        $this->id_page = trim($id_page);
    }

    public function setPageName($page_name) {
        $this->name = trim($page_name);
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
        return $this->name;
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

    public function editorForm() {
		return [
					"config" => [ "method" => "POST", "action" => "", "class" => "form col-md-10"],
					"input" => [
						"TitlePage" =>      [
                                                "title" => "Titre de la page",
                                                "type" => "text",
                                                "placeholder" => "Bienvenue sur ma page",
                        ],
                        "SousTitle" =>      [
                                                "title" => "Couleur",
                                                "type" => "text",
                                                "placeholder" => "Couleur",
                        ]
                    ]
		];
    }
}

?>