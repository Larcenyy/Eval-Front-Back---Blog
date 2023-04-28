<section class="article_container">
    <?php
    foreach($params['articles'] as $article) {
        /* @var User $user */ ?>
        <div class="box_container" data-aos="fade-right"
             data-aos-offset="300"
             data-aos-easing="ease-in-sine">
            <div class="box_infos">
                <h5><?= $article->getTitle() ?></h5>
                <p><?= $article->getContent() ?></p>
                <div class="box_footer">
                    <span><?= $article->getAuthor()->getPseudo() ?></span>
                    <a href="/articles/view/<?= $article->getId() ?>">CONSULTER</a>
                </div>
            </div>
            <img src="<?= $article->getImageUrl() ?>" alt="PhotoArticle">
        </div>
        <?php
    } ?>
</section>
<section class="news" id="news"
     data-aos="flip-left"
     data-aos-easing="ease-out-cubic"
     data-aos-duration="2000">
    <h5>Dernières <span>actualités</span></h5>
    <div class="slide_container slider-1" >
        <?php
        foreach($params['articles'] as $article) {
            /* @var User $user */ ?>
            <div class="slider">
                <img src="<?= $article->getImageUrl() ?>" alt="PhotoArticle">
                <a href="/articles/view/<?= $article->getId() ?>">CONSULTER</a>
            </div>
            <?php
        } ?>
    </div>
    <p>Vous souhaitez créer votre propre articles ? N'hésitez pas</p>
    <button id="createArticle">Créer mon article</button>
    <div class="openSectionArticle" style="width: 100%;">
        <section style="width: 100%;">
            <div class="createContainer">
                <h5>Créer un article</h5>
                <div class="createForm">
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
                        <button id="closeSectionArticle">Annuler</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</section>
<script src="/assets/js/slider.js"></script>