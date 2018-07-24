<?php

class SideMenu {

    public function sideMenuConfigs() {
        $oUser = new Users();
        $oUser->setId( $_SESSION['id_user'] );
        $oIdentity = $oUser->select(array('firstname', 'lastname'))[0];
        $sFirstname = $oIdentity['firstname'];
        $sLastname = $oIdentity['lastname'];
        $sFirstnameLetter = substr($sFirstname, 0, 1);
        $sLastnameLetter = substr($sLastname, 0, 1);

        return [
            "profiles" => ['fName' => $sFirstname, 'lName' => $sLastname, 'sName' => $sFirstnameLetter . $sLastnameLetter],
            "input" => [
                "dashboard" =>      [
                    "title" => "Tableau de bord",
                    "icon" => "controls"
                ],
                "#custom" =>       [
                    "title" => "Personnalisations",
                    "icon" => "notepad-2",
                    "children" => [
                        "sites" => "Identité du site",
                        "homepages" => "Pages d'accueil",
                        "contacts" => "Pages de contact",
                        "legalnotices" => "Mentions légales",
                        "cgvs" => "Conditions générales de vente"
                    ]
                ],
                "categories" =>           [
                    "title" => "Categories",
                    "icon" => "folder-7"
                ],
                "#products" =>        [
                    "title" => "Produits",
                    "icon" => "smartphone-1",
                    "children" => [
                        "products" => "Produit",
                        "colors" => "Couleur",
                        "capacities" => "Capacité de stockage",
                        "images" => "Image",
                    ]
                ],
                "comments" =>  [
                    "title" => "Commentaires",
                    "icon" => "smartphone-10"
                ],
                "users" =>          [
                    "title" => "Utilisateurs",
                    "icon" => "users-1"
                ],
                "orders" =>          [
                    "title" => "Commandes",
                    "icon" => "note"
                ],
                "logout" =>            [
                    "title" => "Déconnexion",
                    "icon" => "exit-1"
                ]
            ]
        ];
    }

}

?>