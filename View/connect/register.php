<section>
    <div class="connect_container">
        <h5>INSCRIPTIONS</h5>
        <div class="connect_form">
            <form action="/validateregister" method="POST">
                <div>
                    <label for="mail">E-mail</label>
                    <input type="email" placeholder="E-mail" name="email" id="mail">
                </div>
                <div>
                    <label for="mail">Pseudonyme</label>
                    <input type="text" placeholder="Votre pseudo" name="username" id="username">
                </div>
                <div>
                    <label for="password_login">Mot de passe</label>
                    <input type="password" placeholder="Votre mot de passe" name="password" id="password_login">
                </div>
                <div>
                    <label for="password_login">Mot de passe confirmation</label>
                    <input type="password" placeholder="Votre mot de passe" name="password-repeat" id="password_login">
                </div>
                <input id="login" type="submit" value="Valider l'inscriptions" name="connect">
                <a href="/connect">Déjà inscrit ?</a>
            </form>
        </div>
    </div>
</section>