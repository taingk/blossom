<?php

$aConfigs = installForm();

if ( $_POST ) {
    $sConfPath = getcwd() . '/conf.inc.php';

    $sConf = '<?php

    define("DBUSER", "'. $_POST['dbuser'] . '");
    define("DBPASSWORD", "'. $_POST['dbpassword'] .'");
    define("DBHOST", "'. $_POST['dbhost'] .'");
    define("DBNAME", "'. $_POST['dbname'] .'");
    define("DBPORT", "'. $_POST['dbport'] .'");
    define("MAILUSER", "'. $_POST['mailuser'] .'");
    define("MAILPASSWORD", "'. $_POST['mailpassword'] .'");
    
    define("DS", DIRECTORY_SEPARATOR);
    $sScriptName = (dirname($_SERVER["SCRIPT_NAME"]) == "/") ? "" : dirname($_SERVER["SCRIPT_NAME"]);
    define("DIRNAME", $sScriptName.DS);';

    try {
        $oPdo = new PDO('mysql:host='.$_POST['dbhost'].';dbname='.$_POST['dbname'].';charset=utf8', $_POST['dbuser'], $_POST['dbpassword']);
        file_put_contents($sConfPath, $sConf);
        return header('Location: /back');

    } catch (PDOException $e) {
        switch ($e->getCode()) {
            case 2002:
                header('Location: /?error=2002');
                break;
            case 1045:
                header('Location: /?error=1045');
                break;
            case 1049:
                header('Location: /?error=1049');
                break;
            }
        }
}

function installForm() {
    return [
                "config" => [ "method" => "POST", "action" => "", "submit" => "Enregistrer les paramètres", "class" => "form col-md-5 row"],
                "input" => [
                    "dbuser" =>         [
                                            "title" => "Nom d'utilisateur de la base de données",
                                            "type" => "text",
                                            "placeholder" => "root"
                                        ],
                    "dbpassword" =>     [
                                            "title" => "Mot de passe de la base de données",
                                            "type" => "password"
                                        ],
                    "dbhost" =>         [
                                            "title" => "Nom d'hôte de la base de données",
                                            "type" => "text",
                                            "placeholder" => "localhost"
                                        ],
                    "dbname" =>         [
                                            "title" => "Nom de la base de données",
                                            "type" => "text",
                                            "placeholder" => "blossom"
                                        ],
                    "dbport" =>         [
                                            "title" => "Numéro de port de la base de données",
                                            "type" => "number",
                                            "placeholder" => "3306"
                                        ],
                    "mailuser" =>       [
                                            "title" => "Email GMAIL pour l'envoie de mail aux utilisateurs",
                                            "type" => "email",
                                            "placeholder" => "blossom@gmail.com",
                                            "required" => true
                                        ],
                    "mailpassword" =>       [
                                            "title" => "Mot de passe de cet email",
                                            "type" => "password",
                                            "required" => true
                                        ]
                ]
    ];
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Installeur</title>
    <link rel="stylesheet" href="/public/css/colors.css">
    <link rel="stylesheet" href="/public/css/grid.css">
    <link rel="stylesheet" href="/public/css/blossom.css">
    <link rel="stylesheet" href="/public/css/form.css">
    <link rel="stylesheet" href="/public/css/auth.tpl.css">
</head>
<body>
    <section class="row gutters container">

        <section class="col-xxs-12 mainView gutters">
            <h1 class="is-third-color">Installation du CMS</h1>
            <hr>

            <?php echo $_GET['error'] == 2002 ? '<section class="row gutters">
                <section id="error" class="col-xxs-12 gutters bg-is-main-color">
                    <h3 class="is-secondary-color">Le nom d\'hôte de la base de données est introuvable.</h3>
                </section></section>
                ' : '' ; ?>

            <?php echo $_GET['error'] == 1045 ? '<section class="row gutters">
                <section id="error" class="col-xxs-12 gutters bg-is-main-color">
                    <h3 class="is-secondary-color">Les identifiants de la base de données sont invalides.</h3>
                </section></section>
                ' : '' ; ?>

            <?php echo $_GET['error'] == 1049 ? '<section class="row gutters">
                <section id="error" class="col-xxs-12 gutters bg-is-main-color">
                    <h3 class="is-secondary-color">Le nom de base de données est inconnue.</h3>
                </section></section>
                ' : '' ; ?>

            <form method="<?php echo $aConfigs["config"]["method"]?>" action="<?php echo $aConfigs["config"]["action"]?>" class="<?php echo $aConfigs["config"]["class"]?>">

                <?php foreach ( $aConfigs["input"] as $sName => $sAttribut ): ?>

                    <label for="<?php echo $sName ?>" class="is-third-color col-xxs-12 text-is-left small-bandeau"><?php echo $sAttribut["title"] ?></label>
                    <input id="<?php echo $sName ?>" class="is-third-color col-xxs-12" type="<?php echo $sAttribut["type"] ?>" 
                    name="<?php echo $sName ?>" 
                    placeholder="<?php echo $sAttribut["placeholder"] ?>" 
                    <?php echo isset( $sAttribut["required"] ) ? "required='required'" : "" ?>
                    value="<?php echo $sAttribut["value"] ?>"/>

                <?php endforeach; ?>

                <input type="submit" class="col-xxs-12 small-bandeau" value="<?php echo $aConfigs["config"]["submit"];?>">

            </form>

            <em class="is-third-color">Nous testons la connexion en base de données une fois que vous enregistrez les paramètres.</em>
            <br>
            <em class="is-third-color"><strong class="is-third-color">Attention</strong>, veuillez entrer un email et un mot de passe GMAIL valide afin de valider votre compte.</em>
            <br>
            <em class="is-third-color">Toutefois, si vous pensez vous être trompé, il est possible de modifier les identifiants dans le fichier conf.inc.php à la racine du projet.</em>

        </section>

    </section>
</body>
</html>