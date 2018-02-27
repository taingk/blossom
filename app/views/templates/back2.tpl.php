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
    <link rel="stylesheet" href="../../public/css/back/adminBar.css">
    <link rel="stylesheet" href="../../public/css/back/sideMenu.css">
    <link rel="stylesheet" href="../../public/css/back/addProducts.css">
    <link rel="stylesheet" href="../../public/css/back/products.css">
    <link rel="stylesheet" href="../../public/css/back/dashboard.css">
    <link rel="stylesheet" href="../../public/css/back/footer.css">

    <script src="http://www.chartjs.org/dist/2.7.1/Chart.bundle.js"></script>
    <script src="http://www.chartjs.org/samples/latest/utils.js"></script>
    <script src="../../public/js/chartjs1.js"></script>
    <script src="../../public/js/chartjs2.js"></script>
    <script src="../../public/js/chartjs3.js"></script>
    <script src="../../public/js/chartjs4.js"></script>
    <script src="../../public/js/onloadchartjs.js"></script>

    <script src="https://code.jquery.com/jquery.min.js"></script>

    <style>    
        body {
            background-color: #F1F1F1;
        }

        header {
            height: 150px;
            background-color: #D8475D;
        }
        header .col-xs-12, header .col-xs-12 .row {
            height: 150px;
        } 
        .backLeftMenu {
            margin-top: -150px;
        }
        .backLeftMenu, .backMenu, main .row {
            height: 100%;
        }
        .profilePicture {
            height: 70px;
            width: 70px;
            border-radius: 50px;
            border: 2px solid white;
        }
        .backMenuLink span {
            display: block; 
        }
        .profile {
            /* background-color: black; */
            background: linear-gradient(
                     rgba(20,20,20, .5), 
                     rgba(20,20,20, .5)),
                     url("https://www.cheapflights.co.uk/news/wp-content/uploads/2016/03/11-photos-that-prove-cherry-blossom-season-is-the-01-620x414.jpg");
        }
        .backMenuLink .row .col-xs-10 {
            text-align: left;
        }
        .backMenuLink .row .col-xs-2 {
            text-align: right;
        }
        main .row section {
            height: calc(100% - 50px);
        }
        .mainMenuContent {
            margin-left:  auto;
            margin-right: auto;
            height: 100%;
            background-color: white;
            box-shadow: 1px 1px 12px #555;
            margin-top: -75px;
        }
        .mainMenuContent .row article {
            margin-top: auto;
            margin-bottom: auto;
        }
        canvas {
            padding: 30px;
        }
        #menuStyle {
            text-align: left;
            margin-bottom: auto;
            margin-top: auto;
            padding: 30px;
        }
    </style>

    
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


    <script>
        $("img#hideBtn").click(function() {
            if($(".backLeftMenu").is(':visible')) {
                $(".backLeftMenu").hide();
                $("#mainMenu").removeClass('col-lg-10').addClass('col-lg-12');                
            } else {
                $(".backLeftMenu").show();
                $("#mainMenu").removeClass('col-lg-12').addClass('col-lg-10');                
            }
        });
    </script>

</body>

</html>