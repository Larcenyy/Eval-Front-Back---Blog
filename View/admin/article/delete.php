<section style="margin-top: 5rem">
    <div class="connect_container">
        <h5>Suppresion d'un article</h5>
        <div class="connect_form">
            <ul>
                <li>
                    <a href="/admin">Retourner sur le panel</a>
                </li>
            </ul>
            <?php
            foreach($params['articles'] as $article) {
                /* @var User $user */ ?>
                <div class="listeArticle">
                    <div class="listeMessage">
                        <h4>Titre : <span><?= $article->getTitle() ?></span></h4>
                    </div>
                    <div class="listeContent">
                        <p><?= $article->getContent() ?></p>
                    </div>
                    <div class="listeFooter">
                        <div>
                            <h4>Autheur : <span><?= $article->getAuthor()->getPseudo() ?></span></h4>
                            <h4>ID : <span>#<?= $article->getId() ?></span></h4>
                        </div>
                        <div>
                            <a href="/articles/delete/<?= $article->getId() ?>">Supprimer</a>
                            <a href="">Verouiller</a>
                            <a href="/articles/modify/<?= $article->getId() ?>">Modifier</a>
                        </div>
                    </div>
                </div>
                <hr>
                <?php
            } ?>
        </div>
    </div>
</section>
