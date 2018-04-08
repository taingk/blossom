<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blossom | Front-Office</title>

    <!-- General CSS -->
    <link rel="stylesheet" href="/public/css/grid.css">
    <link rel="stylesheet" href="/public/css/blossom.css">
    <link rel="stylesheet" href="/public/css/responsiveMenu.css">
    <link rel="stylesheet" href="/public/css/template.front.css">

    <!-- Modules CSS -->
    <link rel="stylesheet" href="/public/css/front/mainMenu.css">

    <!-- Front-office CSS -->
    <link rel="stylesheet" href="/public/css/front/<?php echo $this->sView ?>.css">

    <!-- Footer CSS -->
    <link rel="stylesheet" href="/public/css/front/footer.css">
</head>

<body>

    <header>
        <!-- Main Menu -->
        <?php include("views/front/mainMenu.php") ?>
    </header>

    <main>
        <!-- Main View -->
        <?php include("views/front/" . $this->sView . ".view.php"); ?>
    </main>

    <footer>
        <!-- Footer -->
        <?php include("views/front/footer.view.php")?>
    </footer>

    <script src="/public/js/iconManager.js"></script>
</body>

</html>