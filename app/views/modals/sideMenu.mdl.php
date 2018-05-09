<nav class="col-xs-2 backLeftMenu visible">
    <ul class="backMenu">
        <li class="backMenuLink banner">
            <div class="row">
                <div class="col-xs-10 is-h-centered">
                    <a href="/back/dashboard"><div class="profile-picture is-h-centered bg-is-pink"><?php echo $aProfile['sName'] ?></div></a>
                    <p><a href="/back/users/update?id=<?php echo $_SESSION['id_user'] ?>"><?php echo $aProfile['fName'] ?> <?php echo $aProfile['lName'] ?></a></p>
                    <a href="/"><em>> Retour sur le site</em></a>
                </div>
            </div>
        </li>
        <li class="backMenuLink" id="dashboard">
            <a href="/back/dashboard">Tableau de bord</a>
        </li>
        <li class="backMenuLink" id="pages">
            <a href="/back/pages">Pages</a>
        </li>
        <li class="backMenuLink" id="categories">
            <a href="/back/categories">Categories</a>
        </li>
        <li class="backMenuLink" id="products">
            <a href="/back/products">Produits</a>
        </li>
        <li class="backMenuLink" id="orders">
            <a href="/back/orders">Commandes</a>
        </li>
        <li class="backMenuLink" id="comments">
            <a href="/back/comments">Commentaires</a>
        </li>
        <li class="backMenuLink" id="users">
            <a href="/back/users">Utilisateurs</a>
        </li>
        <li class="backMenuLink">
            <a href="/back/admin/logout">Déconnexion</a>
        </li>
    </ul>
</nav>