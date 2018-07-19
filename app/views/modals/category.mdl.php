<section class="row container mainView box-has-shadow">
    <h1 class="col-xxs-12"></h1>
    <div class="col-xxs-12">
        <div class="row">
            <h1 class="is-black col-xxs-12"><?php echo $aConfigs[0]['label']?></h1>
            
            <!-- <p>Nombre de resultat trouvé : <?php echo count($aConfigs[1]['products'])?></p> -->
            <?php foreach ($aConfigs[1]['products'] as $results): ?>
                
                <div class="col-xxs-3 container padd box-has-shadow ">
                    <a href="/front/product?is=<?php echo $results['id_product']?>" class="is-black">
                        <div class="col-xxs-12 salmon" style="padding-left: 0; padding-right: 0">
                            <strong class="is-black">
                                <?php echo ucfirst($results["product_name"])?>
                            </strong>
                        </div>
                    </a>
                </div>
                    
            <?php endforeach; ?>
        </div>
    </div>
</section>

