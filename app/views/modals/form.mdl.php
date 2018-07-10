<?php
    // à décommenter pour afficher les erreurs
    // print_r($aErrors);
?>

<form method="<?php echo $aConfig["config"]["method"]?>" action="<?php echo $aConfig["config"]["action"]?>" class="<?php echo $aConfig["config"]["class"]?>" enctype="<?php echo $aConfig["config"]["enctype"]?>">


	<?php foreach ( $aConfig["input"] as $sName => $sAttribut ): ?>

        <?php if ( $sAttribut["type"] == "text" || $sAttribut["type"] == "email"
        || $sAttribut["type"] == "number" || $sAttribut["type"] == "password"
        || $sAttribut["type"] == "date" || $sAttribut["type"] == "file" ): ?>

            <label><p class="is-black"><?php echo $sAttribut["title"] ?>
            <input class="is-black" type="<?php echo $sAttribut["type"] ?>" 
            name="<?php echo $sName ?>" 
            placeholder="<?php echo $sAttribut["placeholder"] ?>" 
            <?php echo isset( $sAttribut["required"] ) ? "required='required'" : "" ?>
            value="<?php echo $sAttribut["value"] ?>"/></p></label>

        <?php elseif ( $sAttribut["type"] == "select" ): ?>

            <label><p class="is-black"><?php echo $sAttribut["title"] ?>
            <select name="<?php echo $sName ?>">
                <?php foreach ( $sAttribut["options"] as $sOption ): ?>
                    <option value="<?php echo $sOption['id'] ?>"><?php echo $sOption['name'] ?></option>
                <?php endforeach; ?>
            </select></p></label>

        <?php else: ?>

            <input type="<?php echo $sAttribut["type"] ?>"
            name="<?php echo $sAttribut["name"] ?>"
            id="<?php echo $sAttribut["name"] . '-' . $sName ?>"
            value="<?php echo $sAttribut["value"] ?>"
            <?php echo isset( $sAttribut["checked"] ) ? "checked='checked'" : "" ?>/>
            <label for="<?php echo $sAttribut["name"] . '-' . $sName ?>"><?php echo $sName ?></label>

		<?php endif; ?>

	<?php endforeach; ?>

	<p><input type="submit" value="<?php echo $aConfig["config"]["submit"];?>"></p>

</form>
