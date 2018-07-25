<?php

class AdminController {

    /*
    * Formulaire inscription administrateur
    */
    public function indexAction( $aParams ) {
        $oUser = new Users();

        if ( $oUser->select() ) {
            $oToken = new Token();
            $oToken->checkToken();

            include "controllers/back/DashboardController.class.php";
            $oDashboard = new DashboardController();
            $oDashboard->indexAction( $aParams );

            return;
        }

    	$aConfigs = $oUser->adminFormAdd();
        $aErrors = [];

        if ( !empty( $aParams['POST'] ) ) {
            $aErrors = Validator::checkForm( $aConfigs, $aParams["POST"] );

			if ( empty( $aErrors ) ) {
                $oMailer = new Mailer();
                $oToken = new Token();

                $oMailer->confirmMail($aParams, $oToken->getToken());
                $oUser->setFirstname($aParams['POST']['firstname']);
                $oUser->setLastname($aParams['POST']['lastname']);
                $oUser->setSexe($aParams['POST']['sexe']);
                $oUser->setBirthdayDate($aParams['POST']['birthday_date']);
                $oUser->setEmail($aParams['POST']['email']);
                $oUser->setPwd($aParams['POST']['pwd']);
                $oUser->setToken($oToken->getToken());
                $oUser->setRights(1);
                $oUser->setStatus(0);
                $oUser->save();

                include "controllers/back/IndexController.class.php";
                $oIndex = new IndexController();
                $oIndex->indexAction( [] );

                return;
            }
        }

        $oView = new View("adminAdd", "auth");

        $oView->assign("aConfigs", $aConfigs);
		$oView->assign("aErrors", $aErrors);
    }

    public function logOutAction( $aParams ) {
        session_destroy();
        $_SESSION = [];
        header('Location: /back');
    }

    public function dataAgeAction() {
      $oUser = new Users();
      $aUser = $oUser->select();

      $aData = array();
      foreach ($aUser as $key => $value) {
        if($key == 'birthday_date') {
          $sBirthdayDate = $value['birthday_date'];
          $sBirthdayDate = new DateTime($sBirthdayDate);
          $sTodayDate = new DateTime();
          $sDiff = $sTodayDate->diff($sBirthdayDate);
          $data[] = $sDiff->y;
        }

        $aCountBirthday = array();
        $count1825 = 0;
        $count2535 = 0;
        $count3560 = 0;
        foreach ($data as $value) {
          if($value > 18 && $value < 25) {
            $count1825 += 1;
          }
          if($value > 25 && $value < 35) {
            $count2535 += 1;
          }
          if($value > 35 && $value < 60) {
            $count3560 += 1;
          }
        }
        $aCountBirthday["1825"] = $count1825;
        $aCountBirthday["2535"] = $count2535;
        $aCountBirthday["3560"] = $count3560;
      }
      print(json_encode($aCountBirthday));
    }

    public function dataSexAction() {
      $oUser = new Users();
      $aUser = $oUser->select();

      $aData = array();
      foreach ($aUser as $key => $value) {
        if($key == 'sexe') {
          $aData[] = $value['sexe'];
        }

        $aCountSexe = array();
        $countMale = 0;
        $countFemale = 0;

        foreach ($aData as $value2) {
          if($value2 == 0) {
            $countMale += 1;
          }
          if($value2   == 1) {
            $countFemale += 1;
          }
        }

        $aCountSexe['female'] = $countFemale;
        $aCountSexe['male'] = $countMale;
      }
      print(json_encode($aCountSexe));
    }

}
