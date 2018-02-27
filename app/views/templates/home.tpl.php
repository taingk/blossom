<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blossom | Accueil</title>

    <!-- General CSS -->
    <link rel="stylesheet" href="../../public/css/grid.css">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/responsiveMenu.css">
    <link rel="stylesheet" href="../../public/css/template.home.css">
</head>

<body>

    <header>
        <!-- Header Bar -->
        <?php include("views/home/modules/headerBar.php"); ?>
    </header>

    <main>
        <!-- Main View -->
        <?php include("views/home/" . $this->sView . ".view.php"); ?>
    </main> 

    <footer>
        <!-- Footer -->
        <?php include("views/home/footer.view.php"); ?>
    </footer>

</body>

</html>