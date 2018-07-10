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
        $oView = new View("users", "back");

        if ( !$aParams['POST']['search'] ) {
            $this->listing();
        } else {
            $this->search( $aParams['POST']['search'] );
        }
        
        $this->refactorConfigs();
        $oView->assign("aConfigs", $this->aConfigs );
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
        $this->aConfigs = $this->oUser->userFormAdd();
        $aErrors = [];

        if ( !empty( $aParams['POST'] ) ) {
            $aErrors = Validator::checkForm( $this->aConfigs, $aParams["POST"] );

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
                $this->oUser->setStatus(0);
                $this->oUser->save();
    
                header('location: /back/users ');
                return;
            }
        }

        $oView = new View("usersForm", "back");

        $oView->assign("aConfigs", $this->aConfigs);
		$oView->assign("aErrors", $aErrors);
    }

    /*
    * Update d'un utilisateur en bdd 
    */ 
    public function updateAction( $aParams ) {
        $this->aConfigs = $this->oUser->userFormUpdate();
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
                $this->oUser->save();

                header('location: /back/users');
                return;
            }
        }

        $oView = new View("usersForm", "back");

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

            http_response_code(200);
            echo json_encode(array('status' => 'ok'));
        } else {
            http_response_code(404);            
        }
    }

    /**
     * Mail confirmation
     */
    public function confirmAction( $aParams ) {
        if ( $aParams['GET']['token'] ) {
            $aTokens = $this->oUser->select(array('id_user', 'token'));
            $sToken = null;
            $sId = 0;
            $bCheck = false;

            foreach ( $aTokens as $sKey => $sValue ) {
                if ( $aParams['GET']['token'] === $sValue['token'] ) {
                    $bCheck = true;
                    $sToken = $sValue['token'];
                    $sId = $sValue['id'];
                    break;
                }
            }
    
            if ( $bCheck ) {
                $this->oUser->setId($sId);
                $this->oUser->setStatus(1);
                $this->oUser->save();
    
                header('Location: /back');
            }
        }
    }

    public function refactorConfigs() {        
        $this->aConfigs = $this->oUser->unsetKeyColumns($this->aConfigs, array('date_inserted', 'date_updated', 'token', 'pwd'));
        $this->aConfigs['label'] = array('id', 'prénom', 'nom', 'genre', 'âge', 'email', 'adresse', 'postal', 'ville', 'status', 'options');
        $this->aConfigs['update'] = array('url' => '/back/users/update?id=');
        $this->aConfigs['add'] = array('url' => '/back/users/add');

        foreach ( $this->aConfigs as $sKey => &$aValue ) {
            foreach ( $aValue as $sKey => $sValue ) {
                if ( $sKey === 'birthday_date' ) {
                    $aValue[$sKey] = Helper::getAge($aValue[$sKey]);
                }
                if ( $sKey === 'sexe' ) {
                    $aValue[$sKey] = Helper::getSexe($aValue[$sKey]);
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