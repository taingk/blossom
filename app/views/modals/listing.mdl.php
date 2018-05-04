<section class="small-bandeau">
    <input class="is-black inline" id="search" type="text" />
    <div class="inline" data-icon="search" onclick="search()"></div>
    <a href="<?php echo $aConfig['add']['url'] ?>"><div class="inline is-right" data-icon="add-1"></div></a>
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
                    <a href="<?php echo $aConfig['update']['url'] . $aLists['id_page'] ?>"><div data-icon="settings-5" class="options" id="update-<?php echo $aLists['id_page']?>"></div></a>
                    <div data-icon="<?php echo $aLists['status'] === 'Actif' ? 'locked-4' : 'unlocked-1' ; ?>" class="options" id="lock-<?php echo $aLists['id_page']?>" onclick="updateStatus(this.id)"></div>
                </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>