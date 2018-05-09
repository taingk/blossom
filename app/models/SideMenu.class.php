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
                "pages" =>       [
                    "title" => "Pages",
                    "icon" => "notepad-2"
                ],
                "categories" =>           [
                    "title" => "Categories",
                    "icon" => "folder-7"
                ],
                "products" =>        [
                    "title" => "Produits",
                    "icon" => "smartphone-1"
                ],
                "comments" =>  [
                    "title" => "Commentaires",
                    "icon" => "smartphone-10"
                ],
                "users" =>          [
                    "title" => "Utilisateurs",
                    "icon" => "users-1"
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