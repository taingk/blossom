<?php

class BaseSql {
    private $sTable;
    private $sId;
    private $oPdo;
    private $aColumns;

    public function getTable() {
        return $this->sTable;
    }

    public function getId() {
        return $this->sId;
    }

    public function getPdo() {
        return $this->oPdo;
    }

    public function __construct() {
        // Remplit $sTable par le nom de la classe qui l'appelle, qui vient de models/
        $this->sTable = strtolower(get_called_class());

        if ( $this->sTable == "capacities" ) {
            $this->sId = "id_capacity";
        } else if ( $this->sTable == "categories" ) {
            $this->sId = "id_category";
        } else {
            $this->sId = substr_replace("id_" . $this->sTable, "", -1);
        }

        try {
            // Connexion à la bdd
            $this->oPdo = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.';charset=utf8', DBUSER, DBPASSWORD);
        } catch (Expression $e) {
            die("Erreur " . $e->getMessage());
        }

    }
    
    public function setColumns() {
        $aColumnsExcluded = get_class_vars(get_class());
        // Retire les attributs de cette class : sTable oPdo aColumns
        // On ne garde que les attributs de la classe enfant
        $this->aColumns = array_diff_key(get_object_vars($this), $aColumnsExcluded);
    }
    
    public function save() {
        $this->setColumns();

        if ( $this->aColumns[$this->sId] ) {
            foreach ($this->aColumns as $sKey => $sValue) {
                $aSqlSet[] =  $sKey . " = :" . $sKey;
            }

            $sQuery = "UPDATE " . $this->sTable . " SET " . implode( ", ", $aSqlSet ) . " WHERE " . $this->sId . " = :" . $this->sId;
            $oRequest = $this->oPdo->prepare($sQuery);
            $oRequest->execute($this->aColumns);
        } else {
            unset($this->aColumns[$this->sId]);
            $sUsersColumns = implode(",", array_keys($this->aColumns));
            $sValuesColumns = implode(",:", array_keys($this->aColumns));

            $sQuery = "INSERT INTO " . $this->sTable . " (" .  $sUsersColumns . ")" . " VALUES (:" . $sValuesColumns . ")";
            $oRequest = $this->oPdo->prepare($sQuery);
            $oRequest->execute($this->aColumns);
        }
    }

    public function isLoginValids($sEmail, $sPwd) {
        $sQuery = "SELECT pwd FROM " . $this->sTable . " WHERE email = :email";
        $oRequest = $this->oPdo->prepare($sQuery);
        $oRequest->execute(array(':email' => $sEmail));

        if ( $aResults = $oRequest->fetch() ) {
            if ( password_verify( $sPwd, $aResults['pwd'] ) ) {
                return 1;
            }
        }

        return 0;
    }

    public function setTokenDb( $sEmail, $sToken ) {
        $sQuery = "UPDATE " . $this->sTable . " SET token = :token WHERE email = :email";
        $oRequest = $this->oPdo->prepare( $sQuery );
        $oRequest->execute( array( ':token' => $sToken, ':email' => $sEmail ) );
    }

    public function getTokenDb( $iIdUser ) {
        $sQuery = "SELECT token FROM " . $this->sTable . " WHERE " . $this->sId . " = :" . $this->sId;
        $oRequest = $this->oPdo->prepare( $sQuery );
        $oRequest->execute( array( ':' . $this->sId => $iIdUser) );

        return $oRequest->fetch()['token'];
    }

    public function getUserId( $sEmail ) {
        $sQuery = "SELECT " . $this->sId . " FROM " . $this->sTable . " WHERE email = :email";
        $oRequest = $this->oPdo->prepare( $sQuery );
        $oRequest->execute( array( ':email' => $sEmail ) );

        return $oRequest->fetch()['id_user'];
    }

}