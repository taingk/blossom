<?php

class Users extends BaseSql {
    protected $id = null;
    protected $firstname;
    protected $lastname;
    protected $sexe;
    protected $birthday_date;
    protected $address;
    protected $email;
    protected $zip_code;
    protected $city;
    protected $pwd;
    protected $token;
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

    public function setSexe($sexe) {
        $this->sexe = $sexe;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setZipCode($zip_code) {
        $this->zip_code = $zip_code;
    }

    public function setCity($city) {
        $this->city = $city;
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

    public function setBirthdayDate($birthday_date) {
        $this->birthday_date = $birthday_date;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}

?>