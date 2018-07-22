<section class="row gutters container">
    <section class="col-xxs-12 mainView gutters margin-zero">

        <?php if ( !empty($aErrors) ): ?>
            <ul class="row bg-is-main-color small-bandeau">
                <?php foreach ($aErrors as $errors): ?>
                    <li class="col-xxs-12">
                        <?php echo $errors; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

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

                    <label for="<?php echo $sName ?>" class="is-third-color col-xxs-12 text-is-left small-bandeau"><?php echo $sAttribut["title"] ?></label>
                    <input id="<?php echo $sName ?>" class="is-third-color col-xxs-12" type="<?php echo $sAttribut["type"] ?>" 
                    name="<?php echo $sName ?>" 
                    placeholder="<?php echo $sAttribut["placeholder"] ?>" 
                    <?php echo isset( $sAttribut["required"] ) ? "required='required'" : "" ?>
                    value="<?php echo $sAttribut["value"] ?>"/>

                <?php elseif ( $sAttribut["type"] == "select" ): ?>

                    <label for="<?php echo $sName ?>" class="is-third-color col-xxs-12 text-is-left small-bandeau"><?php echo $sAttribut["title"] ?></label>
                    <select id="<?php echo $sName ?>" name="<?php echo $sName ?>" class="col-xxs-12 is-third-color small-bandeau">
                        <?php foreach ( $sAttribut["options"] as $sOption ): ?>
                            <option class="is-third-color" value="<?php echo $sOption['id'] ?>" <?php echo $sOption['selected'] ? 'selected' : '' ?>><?php echo $sOption['name'] ?></option>
                        <?php endforeach; ?>
                    </select>

                <?php else: ?>

                    <label class="is-third-color col-xxs-12 small-bandeau" for="<?php echo $sAttribut["name"] . '-' . $sName ?>"><?php echo $sName ?></label>
                    <input class="col-xxs-12"
                    type="<?php echo $sAttribut["type"] ?>"
                    name="<?php echo $sAttribut["name"] ?>"
                    id="<?php echo $sAttribut["name"] . '-' . $sName ?>"
                    value="<?php echo $sAttribut["value"] ?>"
                    <?php echo isset( $sAttribut["checked"] ) ? "checked='checked'" : "" ?>/>

                <?php endif; ?>

            <?php endforeach; ?>

            <input type="submit" class="col-xxs-12 small-bandeau" value="<?php echo $aConfigs["config"]["submit"];?>">

        </form>
        
    </section>
</section>