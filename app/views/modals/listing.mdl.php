<table>
    <thead class="bg-is-pink">
        <tr>
            <th>Id</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Genre</th>
            <th>Âge</th>
            <th>Email</th>
            <th>Adresse</th>
            <th>Postal</th>
            <th>Ville</th>
            <th>Status</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($aConfig as $aLists): ?>
        <tr>
            <?php foreach ($aLists as $sValue): ?>
            <td><?php echo $sValue; ?></td>
            <?php endforeach; ?>
            <td>
                <div data-icon="settings-5" class="options"></div>
                <div data-icon="locked-4" class="options"></div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>