<?php   

$oSite = new Sites();
$oSite->setIsUse(1);
$sTitle = $oSite->select()[0]['name'];

?>

<section class="container row">
    <article class="col-xxs-12">
        <p>© 2018 <?php echo $sTitle ? $sTitle : 'Blossom' ?>. Powered by ESGI. All Rights Reserved.</p>
    </article>
    <article class="col-xxs-12">
        <a href="/front/legalnotices">Mentions légales</a>
        -
        <a href="/front/cgvs">Conditions générales de vente</a>
        -
        <a href="/front/contacts">Contacts</a>
    </article>
</section>