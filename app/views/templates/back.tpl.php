<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blossom | Back-office</title>

    <!-- General CSS -->
    <link rel="stylesheet" href="/public/css/grid.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="/public/css/responsiveMenu.css">
    <link rel="stylesheet" href="/public/css/template.back.css">

    <!-- Module CSS -->
    <link rel="stylesheet" href="/public/css/back/redBar.css">
    <link rel="stylesheet" href="/public/css/back/sideMenu.css">

    <!-- Back-office CSS -->
    <link rel="stylesheet" href="/public/css/back/<?php echo $this->sView ?>.css">

    <!-- Footer CSS -->
    <link rel="stylesheet" href="/public/css/back/footer.css">
</head>

<body>

    <header>        
        <!-- Red Bar -->
        <?php in_array($this->sView, $this->aNoInclude) ? : include("views/back/modules/redBar.php") ?>
    </header>

    <main>
        <section class="row">
            <!-- Side Menu -->
            <?php in_array($this->sView, $this->aNoInclude) ? : include("views/back/modules/sideMenu.php") ?>
            <!-- Main View -->
            <section class="col-lg-10">
                <div class="col-lg-11 viewContent">
                    <div class="row">
                        <?php include("views/back/" . $this->sView . ".view.php") ?>
                    </div>
                </div>
            </section>

        </section>
</main>

    <footer>
        <!-- Footer -->
        <?php in_array($this->sView, $this->aNoInclude) ? : include("views/back/footer.view.php")?>
    </footer>

    <!-- Jquery -->
    <script src="/public/js/lib/jquery.min.js"></script>

    <script src="/public/js/iconManager.js"></script>
    <script src="/public/js/sideMenu.js"></script>
</body>

</html>