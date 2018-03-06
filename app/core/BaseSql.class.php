<?php

class BaseSql {
    private $sTable;
    private $oPdo;
    private $aColumns;

    public function __construct() {
        // Remplit $sTable par le nom de la classe qui l'appelle, qui vient de models/
        $this->sTable = strtolower(get_called_class());

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
        // Clean $aColumns
        $this->setColumns();
        
        // Si un id est spécifié, c'est un update
        if ( $this->id ) {

            
        } else {
            // Sinon c'est un insert
            // On retire id comme il est null
            unset($this->aColumns["id"]);

            // On recupere les clé de aColumns et les sépare par ',' et ':' 
            $sUsersColumns = implode(",", array_keys($this->aColumns));
            $sValuesColumns = implode(",:", array_keys($this->aColumns));

            $sQuery = "INSERT INTO " . $this->sTable . " (" .  $sUsersColumns . ")" . " VALUES (:".$sValuesColumns.")";

            // Prepare et execute la requete 
            $oRequest = $this->oPdo->prepare($sQuery);
            // alimenté par le tableau $aColumns
            $oRequest->execute($this->aColumns);
        }
    }
}