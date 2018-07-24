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

    public function siteMapAction() {
        $oLink = new Links();
        $alinks = $oLink->select(array('link'));

        $oProduct = new Products();
        $aProducts = $oProduct->select(array('id_product'));

        $oCategory = new Categories();
        $aCategories = $oCategory->select(array('id_category'));

        $server = $_SERVER['SERVER_NAME'];

        $sitemap = new DOMDocument('1.0',"UTF-8");
        $urlset = $sitemap->createElement("urlset");
        $urlset->setAttribute("xmlns",'http://www.sitemaps.org/schemas/sitemap/0.9');
        $urlset->setAttribute("xmlns:xsi",'http://www.w3.org/2001/XMLSchema-instance');
        $urlset->setAttribute("xsi:schemaLocation",'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');

        foreach( $alinks as $key => $value ) {
            if( $value['link'] == "front/product?is=" ) {
                foreach( $aProducts as $key2 => $value2 ) {
                    $url = $sitemap->createElement("url");
                    $loc = $sitemap->createElement("loc",$server.$value['link'].$value2['id_product']);
                    $changefreq = $sitemap->createElement("changefreq", "daily");
                    $priority = $sitemap->createElement("priority", "0.8");
                    $url->appendChild( $loc );
                    $url->appendChild( $changefreq );
                    $url->appendChild( $priority );
                    $urlset->appendChild($url);
                }
            }
            elseif( $value['link']  == "front/category?is=" ) {
                foreach( $aCategories as $key2 => $value2 ) {
                    $url = $sitemap->createElement("url");
                    $loc = $sitemap->createElement("loc","https://".$server.$value['link'].$value2['id_category']);
                    $changefreq = $sitemap->createElement("changefreq", "daily");
                    $priority = $sitemap->createElement("priority", "0.8");
                    $url->appendChild( $loc );
                    $url->appendChild( $changefreq );
                    $url->appendChild( $priority );
                    $urlset->appendChild($url);
                }
            }
            else {
                $url = $sitemap->createElement("url");
                $loc = $sitemap->createElement("loc",$value['link']);
                $changefreq = $sitemap->createElement("changefreq", "daily");
                $priority = $sitemap->createElement("priority", "0.8");
                $url->appendChild($loc);
                $url->appendChild($changefreq);
                $url->appendChild($priority);
                $urlset->appendChild($url);

            }

        }
        $sitemap->appendChild($urlset);

        $sitemap->save("sitemap.xml");
    }
}
