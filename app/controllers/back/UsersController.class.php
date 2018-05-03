<?php

class UsersController {

    /*
    * View listing des utilisateurs
    */ 
    public function indexAction( $aParams ) {
        $oView = new View("users", "back");
        $oUser = new Users();

        $aConfigs = $oUser->select();
        $aConfigs = $oUser->unsetKeyColumns($aConfigs, array('date_inserted', 'date_updated', 'token', 'pwd'));
        $aConfigs['label'] = array('id', 'prénom', 'nom', 'genre', 'âge', 'email', 'adresse', 'postal', 'ville', 'status', 'options');
        $aConfigs['update'] = array('url' => '/back/users/update?id=');
        $aConfigs['add'] = array('url' => '/back/users/add');

        foreach ( $aConfigs as $sKey => &$aValue ) {
            foreach ( $aValue as $sKey => $sValue ) {
                if ( $sKey === 'id_user' ) {
                    $aTemp = array('id' => $aValue[$sKey]);
                    $aValue = $aTemp + $aValue;
                } 
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
                unset( $aValue['id_user'] );
            }
        }

        $oView->assign("aConfigs", $aConfigs);
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
        $oUser = new Users();
        $aConfigs = $oUser->userFormAdd();
        $aErrors = [];

        if ( !empty( $aParams['POST'] ) ) {
            $aErrors = Validator::checkForm( $aConfigs, $aParams["POST"] );

			if ( empty( $aErrors ) ) {
                $oMailer = new Mailer();
                $oToken = new Token();
                
                $oMailer->sendMail($aParams, $oToken->getToken());
                $oUser->setFirstname($aParams['POST']['firstname']);
                $oUser->setLastname($aParams['POST']['lastname']);
                $oUser->setSexe($aParams['POST']['sexe']);
                $oUser->setBirthdayDate($aParams['POST']['birthday_date']);
                $oUser->setEmail($aParams['POST']['email']);
                $oUser->setPwd($aParams['POST']['pwd']);
                $oUser->setToken($oToken->getToken());
                $oUser->setStatus(0);
                $oUser->save();
    
                header('location: /back/users ');
                return;
            }
        }

        $oView = new View("usersAdd", "back");

        $oView->assign("aConfigs", $aConfigs);
		$oView->assign("aErrors", $aErrors);       
    }

    /*
    * Update d'un utilisateur en bdd 
    */ 
    public function updateAction( $aParams ) {
        $oSelect = new Users();
        $aConfigs = $oSelect->userFormUpdate();
        $aErrors = [];
        $sId = $aParams['GET']['id'];

        $oSelect->setId($sId);
        $aInfos = $oSelect->select()[0];

        foreach ($aConfigs['input'] as $sKey => &$aValue) {
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
            $aErrors = Validator::checkForm( $aConfigs, $aParams["POST"], true );

			if ( empty( $aErrors ) ) {
                $oUser = new Users();

                $oUser->setId($sId);
                $oUser->setFirstname($aParams['POST']['firstname']);
                $oUser->setLastname($aParams['POST']['lastname']);
                $oUser->setSexe($aParams['POST']['sexe']);
                $oUser->setBirthdayDate($aParams['POST']['birthday_date']);
                $oUser->setEmail($aParams['POST']['email']);
                $oUser->setPwd($aParams['POST']['pwd']);
                $oUser->setAddress($aParams['POST']['address']);
                $oUser->setCity($aParams['POST']['city']);
                $oUser->setZipCode($aParams['POST']['postal']);
                $oUser->save();

                header('location: /back/users');
                return;
            }
        }

        $oView = new View("usersUpdate", "back");

        $oView->assign("aConfigs", $aConfigs);
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
            $oUser = new Users();

            $oUser->setId($_GET['id']);
            $sStatus = $oUser->select(array('status'))[0]['status'];

            $sStatus ? $oUser->setStatus(0) : $oUser->setStatus(1);                
            $oUser->save();

            http_response_code(200);
            echo json_encode(array('status' => 'ok'));
        } else {
            http_response_code(404);            
        }
    }

    /*
    * On get un appel AJAX pour rechercher dans la bdd un/des utilisateur(s)
    */ 
    public function searchAction( $aParams ) {
        if ($_POST['search']) {
            $oUser = new Users(); 
            $oUser->setEmail($_POST['search']);
            $oAllEmails = $oUser->search();   

            http_response_code(200);
            echo json_encode($oAllEmails);
        } else {
            http_response_code(404);
        }
    }
    
    /**
     * Mail confirmation
     */
    public function confirmAction( $aParams ) {
        if ( $aParams['GET']['token'] ) {
            $oUser = new Users();
            $aTokens = $oUser->select(array('id_user', 'token'));
            $sToken = null;
            $sId = 0;
            $bCheck = false;

            foreach ( $aTokens as $sKey => $sValue ) {
                if ( $aParams['GET']['token'] === $sValue['token'] ) {
                    $bCheck = true;
                    $sToken = $sValue['token'];
                    $sId = $sValue['id_user'];
                    break;
                }
            }
    
            if ( $bCheck ) {
                $oUser->setId($sId);
                $oUser->setStatus(1);
                $oUser->save();
    
                header('Location: /back');
            }
        }
    }
}