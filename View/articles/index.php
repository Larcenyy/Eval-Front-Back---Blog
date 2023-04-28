
<section>
    <div class="header_article">
        <?php
        /* @var Article $article */ ?>
        <h5><?= $params['article']->getTitle() ?></h5>
        <p><?= $params['article']->getContent() ?></p>
        <span><?= $params['article']->getAuthor()->getPseudo() ?></span>
        <img src="<?= $params['article']->getImageUrl() ?>" alt="PhotoArticle">
        <ul>
            <li>
                <a href="/home">Revenir en arrière</a>
            </li>
        </ul>
        <?php
        ?>
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
                </div>
                <hr>
            <?php } ?>
            </div>
        <?php } ?>
    </div>
    <form action="/sendMessage/<?= $params['article']->getId() ?>" method="post">
        <input type="text" placeholder="Commenter votre avis.." name="comment" required id="message_input">
        <input type="submit" value="PUBLIER" id="send_message">
    </form>

</section>