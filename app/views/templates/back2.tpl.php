<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blossom | Back-office</title>

    <!-- General CSS -->
    <link rel="stylesheet" href="../../public/css/grid.css">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/responsiveMenu.css">
    <link rel="stylesheet" href="../../public/css/template.back.css">

    <!-- Back-office CSS -->
    <link rel="stylesheet" href="../../public/css/back/adminBar2.css">
    <link rel="stylesheet" href="../../public/css/back/sideMenu2.css">
    <link rel="stylesheet" href="../../public/css/back/addProducts.css">
    <link rel="stylesheet" href="../../public/css/back/products.css">
    <link rel="stylesheet" href="../../public/css/back/dashboard.css">
    <link rel="stylesheet" href="../../public/css/back/footer.css">

    <!-- Chartjs -->
    <script src="http://www.chartjs.org/dist/2.7.1/Chart.bundle.js"></script>
    <script src="http://www.chartjs.org/samples/latest/utils.js"></script>
    <script src="../../public/js/chartjs1.js"></script>
    <script src="../../public/js/chartjs2.js"></script>
    <script src="../../public/js/chartjs3.js"></script>
    <script src="../../public/js/chartjs4.js"></script>
    <script src="../../public/js/onloadchartjs.js"></script>
</head>

<body>
    <header>
        <!-- Barre rouge pour display ou hide menu lateral -->
        <?php include("../back/modules/adminBar2.php"); ?>
    </header>

    <main>
        <div class="row">
            <!-- Side Menu -->
            <?php include("../back/modules/sideMenu2.php") ?>
            <!-- Main View -->
            <?php include("../back/dashboard2.view.php") ?>
        </div>
    </main>

    <footer>
    </footer>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="../../public/js/sideMenu.js"></script>
</body>

</html>