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
    <link rel="stylesheet" href="/public/css/back.tpl.css">

    <!-- Module CSS -->
    <link rel="stylesheet" href="/public/css/back/sideMenu.css">

    <!-- Back-office CSS -->
    <link rel="stylesheet" href="/public/css/<?php echo $this->tplPath() ?>.css">

    <!-- Footer CSS -->
    <link rel="stylesheet" href="/public/css/back/footer.css">
</head>

<body>

    <header>
        <!-- Toggle menu -->
        <section class="row height-is-75 bg-is-pink">
            <span class="headNav">
                <div data-icon="menu-2" id="toggleMenu"></div>
            </span>
        </section>
    </header>

    <main>
        <section class="row">
            <!-- Side Menu -->
            <?php include("views/back/sideMenu.php") ?>
            <!-- Main View -->
            <article id="backView" class="col-xxs-10">
                <article class="col-lg-11 viewContent">
                    <section class="row">
                        <?php include("views/" . $this->tplPath() . ".view.php") ?>
                    </section>
                </article>
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
    <script src="/public/js/fetch/back/search.js"></script>
</body>

</html>