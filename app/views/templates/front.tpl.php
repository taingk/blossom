<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $this->sSiteName ? $this->sSiteName : "Blossom" ?></title>
    <link rel="icon" href="<?php echo $this->sFaviconPath ? $this->sFaviconPath : '/public/img/logo.png'; ?>" />

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo $this->bCustomCss ? '/public/css/customColors.css' : '/public/css/colors.css' ?>">
    <link rel="stylesheet" href="/public/css/grid.css">
    <link rel="stylesheet" href="/public/css/blossom.css">
    <link rel="stylesheet" href="/public/css/responsiveMenu.css">
    <link rel="stylesheet" href="/public/css/front.tpl.css">

    <!-- Cart CSS -->
    <link rel="stylesheet" href="/public/css/<?php echo $this->tplPath() ?>.css">
</head>

<body>

    <header>
        <!-- Main Menu -->
        <?php include("views/front/mainMenu.view.php") ?>
    </header>

    <main>
        <!-- Main View -->
        <?php include("views/" . $this->tplPath() . ".view.php"); ?>
    </main>

    <footer>
        <!-- Footer -->
        <?php include("views/front/footer.view.php")?>
    </footer>

    <script src="/public/js/iconManager.js"></script>
    <script src="/public/js/mainMenu.js"></script>
</body>

</html>