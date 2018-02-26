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

    <style>    
        body {
            background-color: #F1F1F1;
        }

        header, .backLeftMenu, .backMenu {
            height: 100%;
        }

        .backMenuLink img {
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
    </style>
</head>

<body>
    <header>        
        <!-- Side Menu -->
        <?php include("../back/modules/sideMenu2.php") ?>
    </header>


    <main>
        <!-- Main View -->
        <?php include("../back/dashboard2.view.php") ?>
    </main>

    <footer>
    </footer>

</body>

</html>