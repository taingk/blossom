<!DOCTYPE html>
<html lang="en" style="height: 100%;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blossom | Page Tableau de bord</title>
    <link rel="stylesheet" href="../../public/css/grid.css">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/responsiveMenu.css">
    <link rel="stylesheet" href="../../public/css/template.back.css">
</head>

<body>
    <header>
        <?php include("../back/modules/adminBar.php") ?>
    </header>


    <main>
        <section class="row back">

            <?php include("../back/modules/sideMenu.php") ?>
            <?php include("../back/dashboard.view.php") ?>

        </section>
    </main>

    <footer>
        <?php include("../back/footer.view.php")?>
    </footer>

</body>

</html>