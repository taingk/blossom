<section class="container">
    <h1>Création du compte administrateur</h1>
    
    <form class="form col-md-10" action="/back/admin/save" method="post">

        <label><p>Prénom
        <input type="text" name="firstname" placeholder="Jean" /></p></label>

        <label><p>Nom de famille
        <input type="text" name="lastname" placeholder="DUPONT" /></p></label>

        <label><p>Date de naissance
        <input type="date" name="birthday_date" placeholder="25" /></p></label>

        <label><p>E-mail
        <input type="text" name="email" placeholder="exemple@email.com" /></p></label>

        <label><p>Mot de passe
        <input type="password" name="pwd" /></p></label>

        <label><p>Confirmer le mot de passe
        <input type="password" name="pwd" /></p></label>

        <p><input type="submit" value="Confirmer" /></p>
    </form>
</section>