<?php

class UsersController {
    private $oUser;
    private $aConfigs;

    public function __construct() {
        $this->oUser = new Users();
    }

    /*
    * View listing des utilisateurs
    */ 
    public function indexAction( $aParams ) {
        $oView = new View("listing", "back");

        if ( !$aParams['POST']['search'] ) {
            $this->listing();
        } else {
            $this->search( $aParams['POST']['search'] );
        }
        
        $this->refactorConfigs();
        $oView->assign( "aConfigs", $this->aConfigs );
        $oView->assign( "aParams", array('id' => 'id_user') );
   }

    /*
    * Liste tous les utilisateurs
    */ 
    public function listing() {
        $this->aConfigs = $this->oUser->select();
    }

    /*
    * On remplie aConfigs par la recherche
    */ 
    public function search( $sSearch ) {
        $this->oUser->setEmail( $sSearch );
        $this->aConfigs = $this->oUser->search();
    }

    /*
    * View profil utilisateur
    */ 
    public function profileAction( $aParams ) {

    }

    /*
    * Formulaire d'ajout utilisateur 
    */ 
    public function addAction( $aParams ) {
        $this->aConfigs = $this->oUser->addUserForm("Ajouter un utilisateur");
        $aErrors = [];

        if ( !empty( $aParams['POST'] ) ) {
            $aErrors = Validator::checkForm( $this->aConfigs, $aParams["POST"] );
            unset($_SESSION['captcha']);
			if ( empty( $aErrors ) ) {
                $oMailer = new Mailer();
                $oToken = new Token();
                
                $oMailer->sendMail($aParams, $oToken->getToken());
                $this->oUser->setFirstname($aParams['POST']['firstname']);
                $this->oUser->setLastname($aParams['POST']['lastname']);
                $this->oUser->setSexe($aParams['POST']['sexe']);
                $this->oUser->setBirthdayDate($aParams['POST']['birthday_date']);
                $this->oUser->setEmail($aParams['POST']['email']);
                $this->oUser->setPwd($aParams['POST']['pwd']);
                $this->oUser->setToken($oToken->getToken());
                $this->oUser->setAddress($aParams['POST']['address']);
                $this->oUser->setCity($aParams['POST']['city']);
                $this->oUser->setZipCode($aParams['POST']['postal']);
                $this->oUser->setRights($aParams['POST']['rights']);
                $this->oUser->setStatus(0);
                $this->oUser->save();
    
                header('location: /back/users ');
                return;
            }
        }

        $oView = new View("editing", "back");

        $oView->assign("aConfigs", $this->aConfigs);
		$oView->assign("aErrors", $aErrors);
    }

    /*
    * Update d'un utilisateur en bdd 
    */ 
    public function updateAction( $aParams ) {
        $this->aConfigs = $this->oUser->updateUserForm();
        $aErrors = [];
        $sId = $aParams['GET']['id'];

        $this->oUser->setId($sId);
        $aInfos = $this->oUser->select()[0];

        foreach ($this->aConfigs['input'] as $sKey => &$aValue) {
            foreach ($aInfos as $sInfoKey => $sInfoValue) {
                if ( $sInfoKey === 'sexe' ) {
                    if ( !$sInfoValue ) {
                        if ( $sKey === 'Masculin' ) {
                            $aValue['checked'] = true;
                        }
                    } else {
                        if ( $sKey === 'Feminin' ) {
                            $aValue['checked'] = true;
                        }
                    }
                }
                if ( $sKey == $sInfoKey && $sKey !== 'pwd') {
                    $aValue['value'] = $sInfoValue;
                }
            }
        }

        if ( !empty( $aParams['POST'] ) ) {
            $aErrors = Validator::checkForm( $this->aConfigs, $aParams["POST"], true );

			if ( empty( $aErrors ) ) {
                $this->oUser->setId($sId);
                $this->oUser->setFirstname($aParams['POST']['firstname']);
                $this->oUser->setLastname($aParams['POST']['lastname']);
                $this->oUser->setSexe($aParams['POST']['sexe']);
                $this->oUser->setBirthdayDate($aParams['POST']['birthday_date']);
                $this->oUser->setEmail($aParams['POST']['email']);
                $this->oUser->setPwd($aParams['POST']['pwd']);
                $this->oUser->setAddress($aParams['POST']['address']);
                $this->oUser->setCity($aParams['POST']['city']);
                $this->oUser->setZipCode($aParams['POST']['postal']);
                $this->oUser->setRights($aParams['POST']['rights']);
                $this->oUser->save();

                header('location: /back/users');
                return;
            }
        }

        $oView = new View("editing", "back");

        $oView->assign("aConfigs", $this->aConfigs);
		$oView->assign("aErrors", $aErrors);
    }

    /*
    * Update des droits utilisateur en bdd 
    */ 
    public function updateRightsAction( $aParams ) {

    }

    /*
    * Suppression d'un utilisateur en bdd
    */ 
    public function deleteAction( $aParams ) {
        if ($_GET['id']) {
            $this->oUser->setId($_GET['id']);
            $sStatus = $this->oUser->select(array('status'))[0]['status'];

            $sStatus ? $this->oUser->setStatus(0) : $this->oUser->setStatus(1);                
            $this->oUser->save();

            header('location: /back/users');
            return;
        }
    }

    /**
     * Mail confirmation
     */
    public function confirmAction( $aParams ) {
        if ( $aParams['GET']['token'] ) {
            $this->oUser->setToken($aParams['GET']['token']);
            $aUser = $this->oUser->select()[0];

            if ( $aUser ) {
                $this->oUser->setId($aUser['id_user']);
                $this->oUser->setStatus(1);
                $this->oUser->save();

                header('Location: /?confirm=true');
            }
        }
    }

    public function refactorConfigs() {
        $this->aConfigs = $this->oUser->unsetKeyColumns($this->aConfigs, array('date_inserted', 'date_updated', 'token', 'pwd'));
        $this->aConfigs['label'] = array('id', 'prénom', 'nom', 'genre', 'âge', 'email', 'adresse', 'postal', 'ville', 'droits', 'status', 'options');
        $this->aConfigs['update'] = array('url' => '/back/users/update?id=');
        $this->aConfigs['delete'] = array('url' => '/back/users/delete?id=');
        $this->aConfigs['add'] = array('url' => '/back/users/add');

        foreach ( $this->aConfigs as $sKey => &$aValue ) {
            foreach ( $aValue as $sKey => $sValue ) {
                if ( $sKey === 'birthday_date' ) {
                    $aValue[$sKey] = Helper::getAge($aValue[$sKey]);
                }
                if ( $sKey === 'sexe' ) {
                    $aValue[$sKey] = Helper::getSexe($aValue[$sKey]);
                }
                if ( $sKey === 'rights' ) {
                    $aValue[$sKey] = Helper::getRights($aValue[$sKey]);
                }
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