<section style="margin-top: 5rem">
    <div class="connect_container">
        <h5>Créer un article</h5>
        <div class="connect_form">
            <ul>
                <li>
                    <a href="/admin">Retourner sur le panel</a>
                </li>
            </ul>
            <form action="/articles/create" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="title_create">Titre du sujet</label>
                    <input type="text" placeholder="Titre de votre sujet" name="title_create" id="title_create" required>
                </div>
                <div>
                    <label for="content">Contenu de l'article :</label>
                    <textarea minlength="60" maxlength="600" placeholder="Contenu de votre article" name="content" id="content" required></textarea>
                </div>
                <div>
                    <label for="image">Image de couverture</label>
                    <input type="file" name="image" id="image" accept="image/*" required>
                </div>
                <p>Votre fichier doit être en .jpg</p>
                <input id="login" type="submit" value="Créer l'article" name="create_content">
            </form>
        </div>
    </div>
</section>
