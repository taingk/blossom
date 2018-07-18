<nav class="col-xs-2 backLeftMenu visible">
    <ul class="backMenu">
        <li class="backMenuLink banner row">
            <div class="col-xs-10 is-h-centered">
                <a href="/back/dashboard"><div class="profile-picture is-h-centered bg-is-main-color"><?php echo $aConfigs['profiles']['sName'] ?></div></a>
                <p><a href="/back/users/update?id=<?php echo $_SESSION['id_user'] ?>" class="is-secondary-color"><?php echo $aConfigs['profiles']['fName'] ?> <?php echo $aConfigs['profiles']['lName'] ?></a></p>
                <a href="/"><em>> Retour sur le site</em></a>
            </div>
        </li>
        <?php
        unset($aConfigs['profiles']);
        foreach ($aConfigs as $sKey => $aValue):
            foreach ($aValue as $sKey => $aMenu):
                if ($sKey != '#custom'): ?>
                <li class="backMenuLink row" id="<?php echo $sKey ?>">
                    <a href="/back/<?php echo $sKey === 'logout' ? 'admin/logout' : $sKey; ?>"><div data-icon="<?php echo $aMenu['icon'] ?>"></div></a>
                    <a href="/back/<?php echo $sKey === 'logout' ? 'admin/logout' : $sKey; ?>" class="is-v-centered"><?php echo $aMenu['title'] ?></a>
                </li>
            <?php else: ?> 
                <li class="backMenuLink row" id="<?php echo $sKey ?>" onClick="openCustomization()">
                    <div data-icon="<?php echo $aMenu['icon'] ?>"></div>
                    <a class="is-v-centered is-third-color" style="cursor: pointer; padding: 0 20px;"><?php echo $aMenu['title'] ?></a>
                    <ul id="submenu">
                    <?php foreach ($aMenu['children'] as $sKey => $sChild): ?>
                        <li id="<?php echo $sKey ?>">
                            <a></a>
                            <a href="/back/<?php echo $sKey ?>">
                                <?php echo $sChild ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </li>
                <? endif;
            endforeach;
        endforeach; ?>
    </ul>
</nav>