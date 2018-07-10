<nav class="col-xs-2 backLeftMenu visible">
    <ul class="backMenu">
        <li class="backMenuLink banner row">
            <div class="col-xs-10 is-h-centered">
                <a href="/back/dashboard"><div class="profile-picture is-h-centered bg-is-pink"><?php echo $aConfig['profiles']['sName'] ?></div></a>
                <p><a href="/back/users/update?id=<?php echo $_SESSION['id_user'] ?>" class="is-white"><?php echo $aConfig['profiles']['fName'] ?> <?php echo $aConfig['profiles']['lName'] ?></a></p>
                <a href="/"><em>> Retour sur le site</em></a>
            </div>
        </li>
        <?php
        unset($aConfig['profiles']);
        foreach ($aConfig as $sKey => $aValue):
            foreach ($aValue as $sKey => $aMenu):?>
            <li class="backMenuLink row" id="<?php echo $sKey ?>">
                <a href="/back/<?php echo $sKey === 'logout' ? 'admin/logout' : $sKey; ?>"><div data-icon="<?php echo $aMenu['icon'] ?>"></div></a>
                <a href="/back/<?php echo $sKey === 'logout' ? 'admin/logout' : $sKey; ?>" class="is-v-centered"><?php echo $aMenu['title'] ?></a>
            </li>
            <?php endforeach;
        endforeach; ?>
    </ul>
</nav>