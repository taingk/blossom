<?php
    // à décommenter pour afficher les erreurs
    // print_r($aErrors);
?>

<form method="<?php echo $aConfig["config"]["method"]?>" action="<?php echo $aConfig["config"]["action"]?>" class="<?php echo $aConfig["config"]["class"]?>" enctype="<?php echo $aConfig["config"]["enctype"]?>">


	<?php foreach ( $aConfig["input"] as $sName => $sAttribut ): ?>

        <?php if ( $sAttribut["type"] == "text" || $sAttribut["type"] == "email"
        || $sAttribut["type"] == "number" || $sAttribut["type"] == "password"
        || $sAttribut["type"] == "date" || $sAttribut["type"] == "file"): ?>

            <label><p class="is-black"><?php echo $sAttribut["title"] ?>
            <input class="is-black" type="<?php echo $sAttribut["type"] ?>" 
            name="<?php echo $sName ?>" 
            placeholder="<?php echo $sAttribut["placeholder"] ?>" 
            <?php echo isset( $sAttribut["required"] ) ? "required='required'" : "" ?>
            value="<?php echo $sAttribut["value"] ?>"/></p></label>

        <?php elseif($sAttribut["type"] == "select"): ?>
        <!-- <select name="test">
            <option value="1" selected="selected">Valeur 1</option>
            <option value="2">Valeur 2</option>
            <option value="3">Valeur 3</option>
            <option value="4">Valeur 4</option>
        </select> -->

		<?php else: ?>

            <input type="<?php echo $sAttribut["type"] ?>"
            name="<?php echo $sAttribut["name"] ?>"
            id="<?php echo $sAttribut["name"] . '-' . $sName ?>"
            value="<?php echo $sAttribut["value"] ?>"
            <?php echo isset( $sAttribut["checked"] ) ? "checked='checked'" : "" ?>/>
            <label for="<?php echo $sAttribut["name"] . '-' . $sName ?>"><?php echo $sName ?></label>


		<?php endif; ?>

	<?php endforeach; ?>

	<p><input class="is-black" type="submit" value="<?php echo $aConfig["config"]["submit"];?>"></p>

</form>
