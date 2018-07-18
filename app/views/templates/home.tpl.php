<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blossom | Accueil</title>

    <!-- General CSS -->
    <link rel="stylesheet" href="/public/css/colors.css">
    <link rel="stylesheet" href="/public/css/grid.css">
    <link rel="stylesheet" href="/public/css/blossom.css">
    <link rel="stylesheet" href="/public/css/responsiveMenu.css">
    <link rel="stylesheet" href="/public/css/home.tpl.css">
</head>

<body>

    <header>
        <!-- Header -->
        <?php include("views/home/header.view.php"); ?>
    </header>

    <main>
        <!-- Main View -->
        <?php include("views/" . $this->tplPath() . ".view.php"); ?>
    </main> 

    <footer>
        <!-- Footer -->
        <?php include("views/home/footer.view.php"); ?>
    </footer>

    <script src="/public/js/iconManager.js"></script>
    <script src="/public/js/scrollDown.js"></script>
</body>

</html>