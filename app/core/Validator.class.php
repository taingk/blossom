<?php

class Validator {

	public static function checkForm( $aConfigs, $aData, $bUpdate = false ) {
		$aErrorsMsg = [];

		foreach ( $aConfigs["input"] as $sName => $sAttribut ) {
			if ( isset( $sAttribut["confirm"] ) && $aData[$sName] != $aData[$sAttribut["confirm"]] ) {
				$aErrorsMsg[] = "Les mots de passes ne correspondent pas";
			} else if ( !isset( $sAttribut["confirm"] ) ) {
				if ( $sAttribut["type"] == "email" && !self::checkSameEmail( $aData[$sName] ) ) {
					$aErrorsMsg[] = "L'email renseigné est déjà utilisé";
				} else if ( $sAttribut["type"] == "email" && !self::checkEmail( $aData[$sName] ) ) {
					$aErrorsMsg[] = "Format de l'email incorrect";
				} else if ( $sAttribut["type"] == "password" && !self::checkPwd( $aData[$sName] ) && !$bUpdate ) {
					$aErrorsMsg[] = "Mot de passe incorrect (au minimum une majuscule, minuscule, chiffre et entre 6 et 32 caractères)";
				} else if ( $sAttribut["type"] == "number" && !self::checkNumber( $aData[$sName ] ) ) {

				}
			}
			// On peut ajouter les cas de types radio / checkbox / etc... dans un nouveau else if

			// Gère les cas "conditions"
			if ( isset( $sAttribut["maxString"] ) && !self::maxString( $aData[$sName], $sAttribut["maxString"] ) ) {
					$aErrorsMsg[] = $sAttribut['title'] . " doit faire moins de " . $sAttribut["maxString"]." caractères" ;
			}
			if ( isset( $sAttribut["minString"] ) && !self::minString( $aData[$sName], $sAttribut["minString"] ) ) {
					$aErrorsMsg[] = $sAttribut['title'] . " doit faire plus de " . $sAttribut["minString"]." caractères" ;
			} 
			if ( isset ($sAttribut["maxNum"] ) && !self::maxNum( $aData[$sName], $sAttribut["maxNum"] ) ) {
					$aErrorsMsg[] = $sAttribut['title'] . " doit être inférieur à " . $sAttribut["maxNum"];
			}
			if ( isset( $sAttribut["minNum"] ) && !self::minNum( $aData[$sName], $sAttribut["minNum"] ) ) {
					$aErrorsMsg[] = $sAttribut['title'] . " doit être supérieur à " . $sAttribut["minNum"];
			}
			if ( isset( $sAttribut["requiredNum"] ) && !self::requiredNum( $aData[$sName], $sAttribut["requiredNum"] ) && !$bUpdate ) {
				$aErrorsMsg[] = $sAttribut['title'] . " doit être égale à " . $sAttribut["requiredNum"];
			}
		}

		return $aErrorsMsg;
	}

	public static function maxString( $sString, $iLength ) {
		return strlen( trim( $sString ) ) <= $iLength;
	}

	public static function minString( $sString, $iLength ) {
		return strlen( trim( $sString ) ) >= $iLength;
	}

	public static function maxNum( $iNum, $iLength ) {
		return $iNum <= $iLength;
	}

	public static function minNum( $iNum, $iLength ) {
		return $iNum >= $iLength;
	}

	public static function requiredNum( $iNum, $iLength ) {
		return strlen($iNum) == $iLength;
	}

	public static function checkSameEmail( $sEmail ) {
		$oUsers = new Users();
		$oUsers->setEmail( $sEmail );
		if( !$oUsers->select() ) {
			return true;
		}
	}

	public static function checkEmail( $sEmail ) {
		return filter_var( $sEmail, FILTER_VALIDATE_EMAIL );			
	}

	public static function checkPwd( $sPwd ) {
		return strlen( $sPwd )>=6 && strlen( $sPwd )<=32 && 
		preg_match( "/[a-z]/", $sPwd ) && 
		preg_match( "/[A-Z]/", $sPwd ) && 
		preg_match( "/[0-9]/", $sPwd );
	}

	public static function checkNumber( $iNumber ) {
		return is_numeric( trim( $iNumber ) );
	}

}
