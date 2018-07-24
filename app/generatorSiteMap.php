<?php

include 'conf.inc.php';

    try {
        // Connexion à la bdd
        $oPdo = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.';charset=utf8', DBUSER, DBPASSWORD);
    } catch (Expression $e) {
        die("Erreur " . $e->getMessage());
    }

    $sQueryProducts = "select `id_product` from products ";
    $oRequestProducts = $oPdo->prepare( $sQueryProducts );
    $oRequestProducts->execute();
    $aResultsProducts = $oRequestProducts->fetchAll();

    $sQueryCapacities = "select `id_capacity` from capacities ";
    $oRequestCapacities = $oPdo->prepare( $sQueryCapacities );
    $oRequestCapacities->execute();
    $aResultsCapacities = $oRequestCapacities->fetchAll();

    $sQueryLinks = "select `link` from links ";
    $oRequestLinks = $oPdo->prepare( $sQueryLinks );
    $oRequestLinks->execute();
    $aResultsLinks = $oRequestLinks->fetchAll();


    $server = $_SERVER['SERVER_NAME'];

    $sitemap = new DOMDocument('1.0',"UTF-8");
    $urlset = $sitemap->createElement("urlset");
    $urlset->setAttribute("xmlns",'http://www.sitemaps.org/schemas/sitemap/0.9');
    $urlset->setAttribute("xmlns:xsi",'http://www.w3.org/2001/XMLSchema-instance');
    $urlset->setAttribute("xsi:schemaLocation",'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');

    foreach( $aResultsLinks as $key => $value ) {
        if( $value['link'] == "/front/product?is=" ) {
            if( !empty($aResultsProducts) ) {
                foreach( $aResultsProducts as $key2 => $value2 ) {
                    $url = $sitemap->createElement("url");
                    $loc = $sitemap->createElement("loc","https://".$server.$value['link'].$value2['id_product']);
                    $changefreq = $sitemap->createElement("changefreq", "daily");
                    $priority = $sitemap->createElement("priority", "0.8");
                    $url->appendChild( $loc );
                    $url->appendChild( $changefreq );
                    $url->appendChild( $priority );
                    $urlset->appendChild( $url );
                }
            }
            else {
                $url = $sitemap->createElement("url");
                $loc = $sitemap->createElement("loc","https://".$server.$value['link']);
                $changefreq = $sitemap->createElement("changefreq", "daily");
                $priority = $sitemap->createElement("priority", "0.8");
                $url->appendChild( $loc );
                $url->appendChild( $changefreq );
                $url->appendChild( $priority );
                $urlset->appendChild( $url );
            }
        }
        elseif( $value['link']  == "/front/category?is=" ) {
            if( !empty($aResultsCapacities) ){
                foreach( $aResultsCapacities as $key2 => $value2 ) {
                    $url = $sitemap->createElement("url");
                    $loc = $sitemap->createElement("loc","https://".$server.$value['link'].$value2['id_category']);
                    $changefreq = $sitemap->createElement("changefreq", "daily");
                    $priority = $sitemap->createElement("priority", "0.8");
                    $url->appendChild( $loc );
                    $url->appendChild( $changefreq );
                    $url->appendChild( $priority );
                    $urlset->appendChild( $url );
                }
            }
            else {
                $url = $sitemap->createElement("url");
                $loc = $sitemap->createElement("loc","https://".$server.$value['link']);
                $changefreq = $sitemap->createElement("changefreq", "daily");
                $priority = $sitemap->createElement("priority", "0.8");
                $url->appendChild( $loc );
                $url->appendChild( $changefreq );
                $url->appendChild( $priority );
                $urlset->appendChild( $url );
            }
        }
        else {
        $url = $sitemap->createElement("url");
        $loc = $sitemap->createElement("loc","https://".$server.$value['link']);
        $changefreq = $sitemap->createElement("changefreq", "daily");
        $priority = $sitemap->createElement("priority", "0.8");
        $url->appendChild( $loc );
        $url->appendChild( $changefreq );
        $url->appendChild( $priority );
        $urlset->appendChild( $url );

        }

    }
    $sitemap->appendChild( $urlset );

    $sitemap->save("sitemap.xml");
