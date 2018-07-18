<section class="row container mainView box-has-shadow">
    <h1 class="is-third-color col-xxs-12 bandeau" style="margin-bottom: 0px"><?php echo $aConfigs[0]['label']?></h1>

    <?php foreach ($aConfigs[1]['products'] as $results): ?>
        
        <a href="/front/product?is=<?php echo $results['id_product']?>" 
        class="col-xxs-12 col-xs-6 col-md-4 row container-product-box">
            <div class="col-xxs-12 product-box bg-is-main-color">
                <!-- <img src="" alt=""> -->
            </div>
            <strong class="col-xxs-12 is-third-color small-bandeau">
                <?php echo $results["product_name"]?>
            </strong>
        </a>
            
    <?php endforeach; ?>
</section>

