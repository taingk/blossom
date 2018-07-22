<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $this->sSiteName ? $this->sSiteName : "Blossom" ?> | Back-office</title>
    <link rel="icon" href="<?php echo $this->sFaviconPath ? $this->sFaviconPath : '/public/img/logo.png'; ?>" />

    <!-- General CSS -->
    <link rel="stylesheet" href="<?php echo $this->bCustomCss ? '/public/css/customColors.css' : '/public/css/colors.css' ?>">
    <link rel="stylesheet" href="/public/css/grid.css">
    <link rel="stylesheet" href="/public/css/blossom.css">
    <link rel="stylesheet" href="/public/css/form.css">
    <link rel="stylesheet" href="/public/css/listing.css">
    <link rel="stylesheet" href="/public/css/back.tpl.css">
</head>

<body>

    <header>
        <!-- Toggle menu -->
        <section class="row height-is-75 bg-is-main-color">
            <span class="headNav">
                <div data-icon="menu-2" id="toggleMenu"></div>
            </span>
        </section>
    </header>

    <main>
        <section class="row">
            <!-- Side Menu -->
            <?php include("views/back/sideMenu.view.php") ?>
            <!-- Main View -->
            <article id="backView" class="col-xxs-10">
                <?php include("views/" . $this->tplPath() . ".view.php") ?>
            </article>
        </section>
    </main>

    <footer>
        <!-- Footer -->
        <?php include("views/back/footer.view.php")?>
    </footer>

    <!-- JS -->
    <script src="/public/js/iconManager.js"></script>
    <script src="/public/js/sideMenu.js"></script>
    <script src="/public/js/back/delete.js"></script>
</body>

</html>