<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blossom | Front-Office</title>

    <!-- General CSS -->
    <link rel="stylesheet" href="../../public/css/grid.css">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/responsiveMenu.css">
    <link rel="stylesheet" href="../../public/css/template.front.css">

    <!-- AdminBar CSS -->
    <link rel="stylesheet" href="../../public/css/back/adminBar.css">

    <!-- Front-office CSS -->
    <link rel="stylesheet" href="../../public/css/front/mainMenu.css">
    <link rel="stylesheet" href="../../public/css/front/footer.css">
    <link rel="stylesheet" href="../../public/css/front/homePage.css">
</head>

<body>
    <header>

        <?php include("../back/modules/adminBar.php") ?>
        <?php include("../front/modules/mainMenu.php") ?>

    </header>

    <main>

        <?php include("../front/homePage.view.php") ?>

    </main>

    <footer>

        <?php include("../front/footer.view.php")?>

    </footer>

</body>

</html>