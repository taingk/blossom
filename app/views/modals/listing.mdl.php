<section class="small-bandeau row">
    <form class="col-xxs-11" action="" method="POST">
        <input class="is-third-color" id="search" name="search" type="text" />
        <input class="default-button" data-icon="search" type="submit" value="" />
    </form>
    <a class="col-xxs-1" href="<?php echo $aConfigs['add']['url'] ?>"><div class="inline" data-icon="add-1"></div></a>
</section>
<table id="listing">
    <thead class="bg-is-main-color">
        <tr>
        <?php foreach ($aConfigs['label'] as $sValue): ?>
            <th><?php echo $sValue; ?></th>
        <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php unset($aConfigs['label']);
        unset($aConfigs['add']);
        $bOptions = false;
        foreach ($aConfigs as $aLists): ?>
        <tr>
            <?php foreach ($aLists as $sKey => $sValue):
                if ( $sKey !== 'url' ):
                    echo '<td>' . $sValue . '</td>';
                else:
                    $bOptions = true;
                endif;
            endforeach;
            if ( !$bOptions ): ?>
                <td>
                    <a href="<?php echo $aConfigs['update']['url'] . $aLists[ $aParams['id'] ] ?>">
                        <div data-icon="settings-5" class="options" id="update-<?php echo $aLists[ $aParams['id'] ]?>"></div>
                    </a>
                    <a href="<?php echo $aConfigs['delete']['url'] . $aLists[ $aParams['id'] ] ?>">
                        <div data-icon="<?php if ( isset($aLists['is_use'] ) ) :
                            echo $aLists['is_use'] === 'Oui' ? 'locked-4' : 'unlocked-1' ;
                        else :
                            echo $aLists['status'] === 'Actif' ? 'locked-4' : 'unlocked-1' ;
                        endif; ?>" class="options" id="lock-<?php echo $aLists[ $aParams['id'] ] ?>"></div>
                    </a>
                </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>