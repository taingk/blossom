<?php

class Validate {

	public static function checkForm( $aConfig, $aData ) {
		$aErrorsMsg = [];

		foreach ( $aConfig["input"] as $sName => $sAttribut ) {
			if ( isset( $sAttribut["confirm"] ) && $aData[$sName] != $aData[$sAttribut["confirm"]] ) {
				$aErrorsMsg[] = $sName . " ne correspond pas à " . $sAttribut["confirm"];
			} else if ( !isset( $sAttribut["confirm"] ) ) {
				if ( $sAttribut["type"] == "email" && !self::checkEmail( $aData[$sName] ) ) {
					$aErrorsMsg[] = "Format de l'email incorrect";
				}else if ( $sAttribut["type"] == "password" && !self::checkPwd( $aData[$sName] ) ) {
					$aErrorsMsg[] = "Mot de passe incorrect(Maj, Min, Chiffre, entre 6 et 32)";
				}else if ( $sAttribut["type"] == "number" && !self::checkNumber( $aData[$sName ] ) ) {
					$aErrorsMsg[] = $sName ." n'est pas correct";
				}
			}
			// On peut ajouter les cas de types radio / checkbox / etc... dans un nouveau else if

			// Gère les cas "conditions"
			if ( isset( $sAttribut["maxString"] ) && !self::maxString( $aData[$sName], $sAttribut["maxString"] ) ) {
					$aErrorsMsg[] = $sName . " doit faire moins de " . $sAttribut["maxString"]." caractères" ;
			}
			if ( isset( $sAttribut["minString"] ) && !self::minString( $aData[$sName], $sAttribut["minString"] ) ) {
					$aErrorsMsg[] = $sName . " doit faire plus de " . $sAttribut["minString"]." caractères" ;
			} 
			if ( isset ($sAttribut["maxNum"] ) && !self::maxNum( $aData[$sName], $sAttribut["maxNum"] ) ) {
					$aErrorsMsg[] = $sName . " doit être inférieur à " . $sAttribut["maxNum"];
			}
			if ( isset( $sAttribut["minNum"] ) && !self::minNum( $aData[$sName], $sAttribut["minNum"] ) ) {
					$aErrorsMsg[] = $sName . " doit être supérieur à " . $sAttribut["minNum"];
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

	public function maxNum( $iNum, $iLength ) {
		return $iNum <= $iLength;
	}

	public function minNum( $iNum, $iLength ) {
		return $iNum >= $iLength;
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
