<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blossom | Page ajout de produits</title>
    <link rel="stylesheet" href="../../public/css/back/addProducts.css">
</head>

<body>
    <section class="col-lg-9 backView">

        <article>
            <div class="col-lg-12">
                <h1>Ajout d'articles</h1>
            </div>
        </article>
        <article>
            <div class="col-lg-6 floatingLeft">
                <div class="container">
                    <div class="col-lg-4 center-container">
                        <div class="blockImage">
                            <div class="elements">
                                <span>Séléctionnez votre image</span>
                                <button>+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        <article class="row">
            <div class="col-lg-6 floatingLeft">
                <div class="container text-left">
                    <form action="" method="post">
                        <label for="title">
                            <span class="titleForm">Titre : </span>
                            <input type="text" name="test" class="inputText">
                        </label>
                        <label for="description">
                            <span class="titleForm">Description de l'article : </span>
                            <textarea></textarea>
                        </label>
                        <label for="price">
                            <span class="titleForm">Prix : </span>
                            <input type="text" name="test" class="inputText">
                        </label>
                        <label for="technical">
                            <span class="titleForm">Champ technique : </span>
                            <input type="text" name="test" class="inputText">
                        </label>
                        <label for="technical2">
                            <span class="titleForm">Champ technique : </span>
                            <input type="text" name="test" class="inputText">
                        </label>
                        <button class="btnValid">Valider</button>
                    </form>
                </div>
            </div>
        </article>

    </section>
</body>

</html>