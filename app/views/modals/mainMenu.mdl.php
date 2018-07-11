<?php var_dump($_SESSION); ?>

<nav class="headerBar position-is-fixed">
    <input class="menu-btn" type="checkbox" id="menu-btn" />
    <label class="menu-icon" for="menu-btn">
        <span class="navicon"></span>
    </label>
    <ul class="row center-in-row menu">
        <li class="col-xxs-1">
            <a href="/">
                <img class="logo" src="<?php echo $aConfig['logo']['url']; unset($aConfig['logo']) ?>">
            </a>
        </li>
        <?php foreach ( $aConfig as $aKeyCategories => $aCategories ): ?>
            <?php foreach ( $aCategories as $sKey => $sValue ): ?>
            <li class="col-xxs-2 main-menu-link">
                <a class="link" href="<?php echo $sValue ?>"><?php echo $aKeyCategories ?></a>
            </li>

            <?php endforeach; ?>
        <?php endforeach; ?>
        <li class="col-xxs-3 col-lg-3">
            <form action="/front/index/search" method="POST">
                <input class="search-input" type="text" name="search">
                <input class="search-icon" type="submit" value=""/>
            </form>
        </li>
        <?php if( !empty( $_SESSION )): ?>
            <li class="col-xxs-1">
                <a href="/front/cart">
                    <input class="cart-icon" type="submit" name="search" value="" />
                </a>
            </li>
        <?php endif; ?>
        <li class="col-xxs-1"></li>
        <li class="col-xxs-1"></li>
        <li class="col-xxs-1"></li>
        <li class="col-xxs-1"></li>
        <li class="col-xxs-1"></li>
        <?php if( !empty( $_SESSION )): ?>
            <li class="col-xxs-1">
                <a href="">
                    Bienvenue, 
                    <?php
                        $oUsers = new Users();
                        $oUsers->setId($_SESSION['id_user']);
                        $aUsers = $oUsers->select()[0];
                        $fullName = $aUsers["firstname"] . " " . $aUsers["lastname"];
                        echo $fullName;
                    ?>
                </a>
            </li>
            <li class="col-xxs-1">
                <a href="/front/user/logOut">
                    Deconnexion
                </a>
            </li>
        <?php else: ?>
            <li class="col-xxs-1">
                <a href="/front/user">
                    Connexion
                </a>
            </li>
            <li class="col-xxs-1">
                <a href="/front/user/subscribe">
                    Inscription
                </a>
            </li>        
        <?php endif; ?>
    </ul>
</nav>

<!-- <section class="row">
    <div class="col-lg-6 menuSlideDownLeft">
        <div class="Smartphones col-sm-10">
            <span>Smartphones</span>
            <hr>
        </div>
    </div>
    <div class="col-lg-6 menuSlideDownRight">
            <a href="#"><img class="frontMenuIcon1" src="../../public/img/samsungFrontMenu.png" alt=""></a> -->
            <!-- <span class="">Samsung Galaxy Note 8</span> -->
            <!-- <a href="#"><img class="frontMenuIcon2" src="../../public/img/iphoneXFrontMenu.png" alt=""></a> -->
            <!-- <span class="">iPhone X</span> -->
            <!-- <a href="#"><img class="frontMenuIcon3" src="../../public/img/htcFrontMenu.png" alt=""></a> -->
            <!-- <span class="">HTC U11</span> -->
    <!-- </div>
</section> -->
