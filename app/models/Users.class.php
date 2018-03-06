<?php

class Users extends BaseSql {
    protected $id = null;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $pwd;
    protected $token;
    protected $age;
    
    protected $status;

    public function __construct() {
        // On instancie le parent 
        parent::__construct();
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setFirstname($firstname) {
        // Kevin
        $this->firstname = ucfirst(strtolower(trim($firstname)));
    }

    public function setLastname($lastname) {
        // TAING
        $this->lastname = strtoupper(trim($lastname));
    }

    public function setEmail($email) {
        // minuscule
        $this->email = strtolower(trim($email));
    }

    public function setPwd($pwd) {
        // Salt unique PAR mot de passe
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }

    public function setToken($token) {
        $this->token = $token;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}

?>