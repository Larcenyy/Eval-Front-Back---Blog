<section style="margin-top: 5rem">
    <div class="connect_container">
        <h5>Modification d'un article</h5>
        <div class="connect_form">
            <ul>
                <li>
                    <a href="/admin">Retourner sur le panel</a>
                </li>
            </ul>
            <?php
            /* @var User $user */ ?>
            <div class="listeArticle">
                <div class="listeMessage">
                    <h4>Titre : <span><?= $params['article']->getTitle() ?></span></h4>
                </div>
                <div class="listeContent">
                    <p><?= $params['article']->getContent() ?></p>
                    <div id="displayArea">
                        <form  style="width: 100%;" action="/articles/modifyArticle/<?= $params['article']->getId() ?>" method="post">
                            <textarea name="areaText" id="areaText" cols="30" rows="10"></textarea>
                            <input type="submit" id="validateArea" value="Enregistrer">
                        </form>
                    </div>
                </div>
                <div class="listeFooter">
                    <div>
                        <h4>Autheur : <span><?= $params['article']->getAuthor()->getPseudo() ?></span></h4>
                        <h4>ID : <span>#<?= $params['article']->getId() ?></span></h4>
                    </div>
                    <div>
                        <button id="modifyMessage"><i class="fas fa-pen"></i></button>

                        <a href="/articles/delete/<?= $params['article']->getId() ?>"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
</section>

<section id="chat_section">
    <div class="chat_container">
        <?php if(empty($params['comment'])) { ?>
            <div class="empty_chat">
                <h5>Aucun commentaire pour le moment.</h5>
            </div>
        <?php } else {
            foreach($params['comment'] as $comment) {
                /* @var Comment $comment */ ?>
                <div class="chat_box">
                <div class="chat_content">
                    <div class="chat_info">
                        <p><?= $comment->getAuthor()->getPseudo() ?></p>
                        <img src="/assets/images/avatar.svg" alt="PhotoArticle">
                    </div>
                    <div class="chat_text">
                        <p><?= $comment->getMessage() ?></p>
                    </div>
                </div>
                <div class="chat_footer">
                    <p>Postée le  <strong><?= $comment->getDate()->format('d-m-Y') ?></strong></p>
                    <a href="/comment/delete/<?= $comment->getId() ?>"><i class="fas fa-trash-alt"></i></a>
                </div>
                <hr>
            <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>