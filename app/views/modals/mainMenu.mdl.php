<nav class="headerBar position-is-fixed">
    <input class="menu-btn" type="checkbox" id="menu-btn" />
    <label class="menu-icon" for="menu-btn">
        <span class="navicon"></span>
    </label>
    <ul class="row center-in-row menu">
        <li class="col-xxs-1">
            <a href="/">
                <img class="logo" src="<?php echo $aConfigs['logo']['url']; unset($aConfigs['logo']) ?>">
            </a>
        </li>
        <li class="col-xxs-1">
            Catégories
        </li>
        <li class="col-xxs-3 col-lg-3">
            <form action="/front/index/search" method="POST">
                <input class="search-input" type="text" name="search">
                <input class="search-icon" type="submit" value=""/>
            </form>
        </li>
        <li class="col-xxs-1">
            <a href="/front/cart">
                <input class="cart-icon" type="submit" name="search" value="" />
            </a>
        </li>
        <li class="col-xxs-1">
            <a href="">
                Connexion
            </a>
        </li>
        <li class="col-xxs-1">
            <a href="/front/user/subscribe">
                Inscription
            </a>
        </li>
    </ul>
</nav>
<nav class="">
<?php foreach ( $aConfigs as $aKeyCategories => $aCategories ): ?>
    <?php foreach ( $aCategories as $sKey => $sValue ): ?>
    <li class="col-xxs-2 main-menu-link">
        <a class="link" href="<?php echo $sValue ?>"><?php echo $aKeyCategories ?></a>
    </li>

    <?php endforeach; ?>
<?php endforeach; ?>
</nav>