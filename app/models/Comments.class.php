<?php

class Comments extends BaseSql {
    protected $id_comment = null;
    protected $comment;
    protected $users_idusers;
    protected $products_idproduct;
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

    public function setId($id) {
        $this->id_comment = trim($id);
    }

    public function setComment($comment) {
        $this->comment = trim($comment);
    }

    public function setUsersIdUsers($users_idusers) {
        $this->users_idusers = trim($users_idusers);
    }

    public function setProductsIdProduct($products_idproduct) {
        $this->products_idproduct = trim($products_idproduct);
    }

    public function getIdComment()
    {
        return $this->id_comment;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getUsersIdusers()
    {
        return $this->users_idusers;
    }

    public function getProductsIdproduct()
    {
        return $this->products_idproduct;
    }

    public function commentForm($sTitle = "") {
		return [
					"config" => [ "method" => "POST", "action" => "", "submit" => "Enregistrer votre commentaire", "class" => "form col-md-5 row", "pageTitle" => $sTitle],
					"input" => [
						"comment" =>      [
                                                "title" => "Votre commentaire",
                                                "type" => "text",
                                                "required" => true,
                                        ],
					]
		];
    }
}

?>