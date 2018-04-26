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
                <td><?php echo $aLists['id_user']; ?></td>
                <td><?php echo $aLists['firstname']; ?></td>
                <td><?php echo $aLists['lastname']; ?></td>
                <td><?php echo $aLists['sexe'] ? "Femme" : "Homme"; ?></td>
                <td><?php echo Helper::getAge($aLists['birthday_date']); ?></td>
                <td><?php echo $aLists['email']; ?></td>
                <td><?php echo $aLists['adress'] ? : "Non renseigné"; ?></td>
                <td><?php echo $aLists['zip_code'] ? : "Non renseigné"; ?></td>
                <td><?php echo $aLists['city'] ? : "Non renseigné"; ?></td>
                <td><?php echo $aLists['status']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>