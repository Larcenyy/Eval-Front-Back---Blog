<section>
    <div class="connect_container">
        <h5>CONNEXION</h5>
        <div class="connect_form">
            <form action="/login" method="POST">
                <div>
                    <label for="mail">E-mail</label>
                    <input type="email" placeholder="E-mail" name="email_login" id="mail">
                </div>
                <div>
                    <label for="password_login">Mot de passe</label>
                    <input type="password" placeholder="Votre mot de passe" name="password_login" id="password_login">
                </div>
                <input id="login" type="submit" value="Se connecter" name="connect">
                <a href="/register">Pas encore inscrit ?</a>
            </form>
        </div>
    </div>
</section>