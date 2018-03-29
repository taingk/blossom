<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blossom | Back-office</title>

    <!-- General CSS -->
    <link rel="stylesheet" href="/public/css/grid.css">
    <link rel="stylesheet" href="/public/css/blossom.css">
    <link rel="stylesheet" href="/public/css/form.css">
    <link rel="stylesheet" href="/public/css/template.back.css">

    <!-- Module CSS -->
    <link rel="stylesheet" href="/public/css/back/redBar.css">
    <?php if ( !in_array($this->sView, $this->aNoInclude) ) echo '<link rel="stylesheet" href="/public/css/back/sideMenu.css">'; ?>

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
            <section id="backView" class="<?php if ( in_array($this->sView, $this->aNoInclude) ) echo 'is-centered'; else echo 'col-xxs-10' ?>">
                <div class="<?php if ( !in_array($this->sView, $this->aNoInclude) ) echo 'col-lg-11'; ?> viewContent">
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

    <!-- JS -->
    <script src="/public/js/iconManager.js"></script>
    <?php if ( !in_array($this->sView, $this->aNoInclude) ) echo '<script src="/public/js/sideMenu.js"></script>'; ?>
</body>

</html>