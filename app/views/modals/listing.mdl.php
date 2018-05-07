<section class="small-bandeau row">
    <form class="col-xxs-11" action="" method="POST">
        <input class="is-black" id="search" name="search" type="text" />
        <input class="default-button" data-icon="search" type="submit" value="" />
    </form>
    <a class="col-xxs-1" href="<?php echo $aConfig['add']['url'] ?>"><div class="inline" data-icon="add-1"></div></a>
</section>
<table id="listing">
    <thead class="bg-is-pink">
        <tr>
        <?php foreach ($aConfig['label'] as $sValue): ?>
            <th><?php echo $sValue; ?></th>
        <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php unset($aConfig['label']);
        unset($aConfig['add']);
        $bOptions = false;
        foreach ($aConfig as $aLists): ?>
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
                    <a href="<?php echo $aConfig['update']['url'] . $aLists['id'] ?>"><div data-icon="settings-5" class="options" id="update-<?php echo $aLists['id']?>"></div></a>
                    <div data-icon="<?php echo $aLists['status'] === 'Actif' ? 'locked-4' : 'unlocked-1' ; ?>" class="options" id="lock-<?php echo $aLists['id']?>" onclick="updateStatus(this.id)"></div>
                </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>