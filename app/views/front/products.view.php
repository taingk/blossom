<section class="row container mainView box-has-shadow">
    <h1 class="col-xxs-12">Produits</h1>
    <div class="col-xxs-12">
        <div class="row">
            <?php foreach ($products as $results): ?>
                <div class="col-xxs-6 gutters">
                    <div class="col-xxs-3">
                        <p class="is-black">
                            <strong class="is-black">
                                <?php echo strtolower(ucfirst($results["product_name"]))?>
                            </strong>
                        </p>
                    </div>
                    <p class="is-black">Prix du produit: <?php echo $results["price"]?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
