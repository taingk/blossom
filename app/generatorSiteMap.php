<?php

    try {
        // Connexion à la bdd
        $this->oPdo = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.';charset=utf8', DBUSER, DBPASSWORD);
    } catch (Expression $e) {
        die("Erreur " . $e->getMessage());
    }

    $sQuery = "SELECT 'id_product' FROM products";
    $oRequest = $this->oPdo->prepare( $sQuery );
    $oRequest->execute( $this->aColumns );
    $aResults = $oRequest->fetchAll();

    $aIdProducts = $this->unsetIntegerColumns( $aResults );

    print_r($aIdProducts);

    $server = $_SERVER['SERVER_NAME'];

    $sitemap = new DOMDocument('1.0',"UTF-8");
    $urlset = $sitemap->createElement("urlset");
    $urlset->setAttribute("xmlns",'http://www.sitemaps.org/schemas/sitemap/0.9');
    $urlset->setAttribute("xmlns:xsi",'http://www.w3.org/2001/XMLSchema-instance');
    $urlset->setAttribute("xsi:schemaLocation",'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');

    foreach( $alinks as $key => $value ) {
    print_r($alinks);
        if( $value['link'] == "/front/product?is=" ) {
            foreach( $aIdProducts as $key2 => $value2 ) {
            $url = $sitemap->createElement("url");
            $loc = $sitemap->createElement("loc","https://".$server.$value['link'].$value2['id_product']);
            $changefreq = $sitemap->createElement("changefreq", "daily");
            $priority = $sitemap->createElement("priority", "0.8");
            $url->appendChild( $loc );
            $url->appendChild( $changefreq );
            $url->appendChild( $priority );
            $urlset->appendChild($url);
            }
        }
        elseif( $value['link']  == "/front/category?is=" ) {
            foreach( $aCategories as $key2 => $value2 ) {
            print_r($aCategories);
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
        $loc = $sitemap->createElement("loc","https://".$server.$value['link']);
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
