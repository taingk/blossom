<?php if(!empty($aErrors)) {?>
    <div class="errorContainer">
        <ul>
            <?php foreach ($aErrors as $errors): ?>
                <li>
                    <?php echo $errors; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php } ?>

<form method="<?php echo $aConfigs["config"]["method"]?>" action="<?php echo $aConfigs["config"]["action"]?>" class="<?php echo $aConfigs["config"]["class"]?>" enctype="<?php echo $aConfigs["config"]["enctype"]?>">

    <?php if ($aConfigs["config"]["pageTitle"]): ?>
        <p class="medium-bandeau is-third-color is-font-title">
            <?php echo $aConfigs["config"]["pageTitle"]?>
        </p>
    <?php endif; ?>

	<?php foreach ( $aConfigs["input"] as $sName => $sAttribut ): ?>

        <?php if ( $sAttribut["type"] == "text" || $sAttribut["type"] == "email"
        || $sAttribut["type"] == "number" || $sAttribut["type"] == "password"
        || $sAttribut["type"] == "date" || $sAttribut["type"] == "file" ): ?>

            <label><p class="is-third-color"><?php echo $sAttribut["title"] ?>
            <input class="is-third-color" type="<?php echo $sAttribut["type"] ?>" 
            name="<?php echo $sName ?>" 
            placeholder="<?php echo $sAttribut["placeholder"] ?>" 
            <?php echo isset( $sAttribut["required"] ) ? "required='required'" : "" ?>
            value="<?php echo $sAttribut["value"] ?>"/></p></label>

        <?php elseif ( $sAttribut["type"] == "select" ): ?>

            <label><p class="is-third-color"><?php echo $sAttribut["title"] ?>
            <select name="<?php echo $sName ?>" style='width:100px; color:black;'>
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
            <label class="is-third-color" for="<?php echo $sAttribut["name"] . '-' . $sName ?>"><?php echo $sName ?></label>

		<?php endif; ?>

	<?php endforeach; ?>

	<p><input type="submit" value="<?php echo $aConfigs["config"]["submit"];?>"></p>

</form>
