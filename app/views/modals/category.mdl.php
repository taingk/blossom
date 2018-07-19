<section class="row container mainView gutters">
    <h1 class="is-third-color col-xxs-12"><?php echo $aConfigs[0]['label']?></h1>
    <hr>

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

