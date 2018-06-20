<?php

class Pages extends BaseSql
{
    protected $id_page = null;
    protected $name;
    protected $type;
    protected $content;
    protected $is_use;
    protected $status;

    public function __construct()
    {
        // On instancie le parent
        parent::__construct();
    }

    public function setId($id_page)
    {
        $this->id_page = trim($id_page);
    }

    public function setPageName($page_name)
    {
        $this->name = trim($page_name);
    }

    public function setType($type)
    {
        $this->type = trim($type);
    }

    public function setContent($content)
    {
        $this->content = trim($content);
    }

    public function setIsUse($is_use)
    {
        $this->is_use = trim($is_use);
    }

    public function setStatus($status)
    {
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

    public function editorForm()
    {
        return [
            "config" => ["method" => "POST", "action" => "", "class" => "form col-md-4", "enctype" => "multipart/form-data", "submit" => "Enregistrer une page d'accueil", "pageTitle" => "Ajouter une nouvelle page d'accueil"],
            "input" => [
                "titlePage" => [
                    "title" => "Titre de la page d'accueil",
                    "type" => "text",
                    "placeholder" => "Ajouter un titre",
                ],
                "descriptionPage" => [
                    "title" => "Description du site",
                    "type" => "text",
                    "placeholder" => "Ajouter une description",
                ],
                "banner" => [
                    "title" => "Upload l'image bannière",
                    "type" => "file",
                    "placeholder" => "Ajouter une image",
                ],
                "leftImage" => [
                    "title" => "Upload l'image gauche",
                    "type" => "file",
                    "placeholder" => "Ajouter une image",
                ],
                "rightImage" => [
                    "title" => "Upload l'image droite",
                    "type" => "file",
                    "placeholder" => "Ajouter une image",
                ],
                "bottomBanner" => [
                    "title" => "Upload l'image bannière de bas",
                    "type" => "file",
                    "placeholder" => "Ajouter une image",
                ]
            ]
        ];
    }
}

?>
