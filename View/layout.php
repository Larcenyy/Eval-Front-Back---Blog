<?php

    use App\Model\Manager\UserManager;
    $user = new \App\Model\Entity\User();
    $userManager = new UserManager();
    $userIsAdmin = $userManager->isAdmin($user);
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/sass/main.css">
    <link rel="shortcut icon" href="/assets/images/pop_nobg.png" type="image/x-icon">
    <title>Pop Blog | Your Blog</title>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
          integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li>
                    <div>
                        <a href="/">Accueil</a>
                        <a href="#news">Nouveautés</a>
                    </div>
                </li>
                <h1>POP BLOG</h1>

                <?php if ($user->getIsAdmin()) : ?>
                    <li><a href="/admin">ADMINISTRATIONS</a></li>
                <?php endif; ?>

                <?php if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"]) : ?>
                    <li><a href="/logout">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="/connect">CONNEXION</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <div class="burgerMenu">
        <p id="burgerButton"><i class="fas fa-ellipsis-v"></i></p>
        <div class="burgerList">
            <i class="fas fa-times" id="closeBurger"></i>
            <ul>
                <li><a href="/">Accueil</a></li>
                <li><a href="/home#news">Nouveautés</a></li>
                <li><a href="/admin">ADMINISTRATIONS</a></li>
                <?php if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"]) : ?>
                    <li><a href="/logout">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="/connect">CONNEXION</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>


    <?= $html ?>

    <footer>
        <div>
            <hr>
            <p>(c) Pop Blog | Tout droit réservé - 2023</p>
        </div>
    </footer>

    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/modifArticle.js"></script>
</body>
</html>
