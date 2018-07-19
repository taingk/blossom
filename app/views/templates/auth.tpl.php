<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $this->sSiteName ? $this->sSiteName : "Blossom" ?></title>
    <link rel="icon" href="<?php echo $this->sFaviconPath ? $this->sFaviconPath : '/public/img/logo.png'; ?>" />

    <!-- General CSS -->
    <link rel="stylesheet" href="<?php echo $this->bCustomCss ? '/public/css/customColors.css' : '/public/css/colors.css' ?>">
    <link rel="stylesheet" href="/public/css/grid.css">
    <link rel="stylesheet" href="/public/css/blossom.css">
    <link rel="stylesheet" href="/public/css/form.css">
    <link rel="stylesheet" href="/public/css/auth.tpl.css">

    <!-- Auth CSS -->
    <link rel="stylesheet" href="/public/css/<?php echo $this->tplPath() ?>.css">

</head>

<body>

    <main>
        <section class="row">
            <!-- Main View -->
            <article id="backView" class="is-h-centered">
                <article class="viewContent box-has-shadow">
                    <section class="row">
                        <?php include("views/" . $this->tplPath() . ".view.php") ?>
                    </section>
                </article>
            </article>
        </section>
    </main>

    <!-- JS -->
    <script src="/public/js/iconManager.js"></script>
</body>

</html>