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
            foreach ($aConfig as $aLists): ?>
        <tr>
            <?php foreach ($aLists as $sValue): ?>
            <td><?php echo $sValue; ?></td>
            <?php endforeach; ?>
            <td>
                <div data-icon="settings-5" class="options" id="update-<?php echo $aLists['id_user']?>" onclick="update(this.id)"></div>
                <div data-icon="<?php echo $aLists['status'] === 'Actif' ? 'locked-4' : 'unlocked-1' ; ?>" class="options" id="lock-<?php echo $aLists['id_user']?>" onclick="updateStatus(this.id)"></div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>