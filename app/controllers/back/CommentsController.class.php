<?php

class CommentsController {
    private $oComment;
    private $aConfigs;

    public function __construct() {
        $this->oComment = new Comments();
    }
    /*
    * View listing des commentaires pour tel produit
    * par tel utilisateur inscrit
    */ 
    public function indexAction( $aParams ) {
        
        $oView = new View("listing", "back");

        if ( !$aParams['POST']['search'] ) {
            $this->listing();
        } else {
            $this->search( $aParams['POST']['search'] );
        }

        $this->refactorConfigs();
        $oView->assign("aConfigs", $this->aConfigs );
        $oView->assign( "aParams", array('id' => 'id_comment') );
    }

    /*
    * Listes tous les commentaires
    */
    public function listing() {
        $this->aConfigs = $this->oComment->select();
    }

    /*
    * View profil commentaire
    */ 
    public function profileAction( $aParams ) {

    }

    /*
    * Formulaire d'ajout de commentaire
    */ 
    public function addAction( $aParams ) {
   
    }

    /*
    * Formulaire d'édition d'un commentaire 
    * Edite, accepte et refuse un commentaire
    */
    public function updateAction( $aParams ) {
        $this->aConfigs = $this->oComment->commentForm("Editer le commentaire");
        $sId = $aParams['GET']['id'];

        $this->oComment->setId($sId);
        $aInfos = $this->oComment->select()[0];

        foreach ($this->aConfigs['input'] as $sKey => &$aValue) {
            foreach ($aInfos as $sInfoKey => $sInfoValue) {
                if ( $sKey == $sInfoKey) {
                    $aValue['value'] = $sInfoValue;
                }
            }
        }

        if ( !empty( $aParams['POST'] ) ) {

			if ( empty( $aErrors ) ) {
                $this->oComment->setId($sId);
                $this->oComment->setComment($aParams['POST']['comment']);
                $this->oComment->save();

                header('location: /back/comments');
                return;
            }
        }

        $oView = new View("editing", "back");
        $oView->assign("aConfigs", $this->aConfigs);
    }

    /*
    * Suppression d'un commentaire en bdd
    */ 
    public function deleteAction( $aParams ) {
        if ($_GET['id']) {
            $this->oComment->setId($_GET['id']);
            $sStatus = $this->oComment->select(array('status'))[0]['status'];

            $sStatus ? $this->oComment->setStatus(0) : $this->oComment->setStatus(1);                
            $this->oComment->save();

            header('location: /back/comments');
            return;
        }
    }

    /*
    * On get un appel AJAX pour rechercher dans la bdd un/des produit(s)
    */ 
    public function search( $sSearch ) {
        $this->oComment->setComment( $sSearch );
        $this->aConfigs = $this->oComment->search();
    }

    public function refactorConfigs() {
        $this->aConfigs = $this->oComment->unsetKeyColumns($this->aConfigs, array('date_inserted', 'date_updated'));
        $this->aConfigs['label'] = array('id', 'commentaire', 'id_user', 'id_produit', 'status', 'options');
        $this->aConfigs['update'] = array('url' => '/back/comments/update?id=');
        $this->aConfigs['delete'] = array('url' => '/back/comments/delete?id=');

        foreach ( $this->aConfigs as $sKey => &$aValue ) {
            foreach ( $aValue as $sKey => $sValue ) {
                if ( $sKey === 'status' ) {
                    $aValue[$sKey] = Helper::getStatus($aValue[$sKey]);
                }
                if ( $aValue[$sKey] == '' ) {
                    $aValue[$sKey] = 'Non renseigné';
                }
            }
        }
    }

}