<?php

namespace App\Controller;

use App\Model\DB;
use App\Model\Manager\UserManager;

class LoginController extends AbstractController
{
    /**
     * Permet le listing de tous les articles.
     * @return void
     */
    public function index()
    {
        if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"]) {
            header("Location: /home");
        }
        else {
            $this->display('connect/login');
        }
    }

    public function indexRegister()
    {
        if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"]) {
            header("Location: /home");
        }
        else {
            $this->display('connect/register');
        }
    }

    public function logout()
    {
        if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"]) {
            $_SESSION["authenticated"] = false;
            $_SESSION = array();
            session_destroy();

            header('Location: /connect');
            exit;
        }
        else {
            header("Location: /connect");
        }
    }

    public function checkLogin()
    {
        $sql = "SELECT id, pseudo, password, email, is_admin FROM pop_user WHERE email = :email";
        $req = DB::getInstance()->prepare($sql);

        $email = strip_tags($_POST['email_login'] ?? ''); // Supprime toutes les balises HTML potentiellement dangereuses
        $pass_form = strip_tags($_POST['password_login'] ?? ''); // Récupère le mot de passe entré dans le formulaire et supprime les balises HTML potentiellement dangereuses

        $req->bindParam(':email', $email);

        $pass_form = strip_tags($pass_form); // Supprime les balises HTML et PHP
        password_hash($pass_form, PASSWORD_BCRYPT); // Step 2 on le filtre

        if ($email && $pass_form) { // Check si les champs on était trouvé
            if ($req->execute()) {
                $userData = $req->fetch(); // Met notre $req en tableau associatif
                if (!empty($userData)) { // Va check si c'est vrai
                    if (password_verify($pass_form, $userData['password'])) { // Check si le mot de passe en clair > filtrer et égal aux mot de passe enregistrer dans la bdd
                        $id = $userData['id']; // Récupère l'ID de l'utilisateur

                        $_SESSION["authenticated"] = true;

                        $_SESSION["user"] = [
                            "name" => $userData['pseudo'],
                            "email" => $userData['email'],
                            "is_admin" => $userData['is_admin'],
                            "id_user" => $userData['id'],
                        ];

                        header("Location: /home");

                        echo("<div class='warning'> Vous vous êtes login avec succès ! </div>");
                        echo "<script>setTimeout(function(){ document.querySelector('.warning').style.display = 'none'; }, 15000);</script>";

                    } else {
                        echo("<div class='warning'> Mot de passe incorrect.. </div>");
                        echo "<script>setTimeout(function(){ document.querySelector('.warning').style.display = 'none'; }, 3000);</script>";
                        $this->display('connect/login');
                    }
                } else {
                    echo "<div class='warning'> Aucun e-mail trouvé sous le nom : " . $email . "</div>";
                    echo "<script>setTimeout(function(){ document.querySelector('.warning').style.display = 'none'; }, 3000);</script>";
                    $this->display('connect/login');
                }
            } else {
                echo "<div class='warning'> Aucun compte associé à ce nom d'utilisateur </div>";
                echo "<script>setTimeout(function(){ document.querySelector('.warning').style.display = 'none'; }, 3000);</script>";
                $this->display('connect/login');
            }
        } else {
            echo "<div class='warning'> Aucun champ trouvé..  </div>";
            echo "<script>setTimeout(function(){ document.querySelector('.warning').style.display = 'none'; }, 3000);</script>";
            $this->display('connect/login');
        }
    }


    public function registerUser()
    {
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password-repeat']) && isset($_POST['email'])) {
            $username = strip_tags($_POST['username']);
            $user_email = strip_tags($_POST['email']);


            // Vérifier si l'email est valide
            $username = preg_replace('/[^a-zA-Z0-9]+/', '', strtr(trim($_POST['username']), 'àáâäãåçèéêëìíîïñòóôöõøùúûüýÿ', 'aaaaaaceeeeiiiinooooouuuuyy'));
            $user_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Filtrer l'adresse e-mail pour retirer les caractères spéciaux
            if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                echo "<div class='warning'> Cette adresse email n'est pas valide. </div>";
                echo "<script>setTimeout(function(){ document.querySelector('.warning').style.display = 'none'; }, 6000);</script>";
                return;
            }

            if (!preg_match('/^[a-zA-Z]+$/', $_POST['username'])) {
                echo "<div class='warning'> Le nom d'utilisateur ne doit contenir que des caractères alphabétiques non accentués. </div>";
                echo "<script>setTimeout(function(){ document.querySelector('.warning').style.display = 'none'; }, 6000);</script>";
                return;
            }

            // Vérifier si le nom d'utilisateur existe déjà
            $sql = "SELECT id FROM pop_user WHERE pseudo = :username";
            $req = DB::getInstance()->prepare($sql);

            $req->bindParam(':username', $username);
            $req->execute();
            $result = $req->fetch();
            if ($result) {
                echo "<div class='warning'> Nom d'utilisateur déjà pris. </div>";
                echo "<script>setTimeout(function(){ document.querySelector('.warning').style.display = 'none'; }, 6000);</script>";
                $this->display('connect/register');
                return;
            }

            // Vérifier si l'adresse email existe déjà
            $sql = "SELECT id FROM pop_user WHERE email = :email";
            $req = DB::getInstance()->prepare($sql);

            $req->bindParam(':email', $user_email);
            $req->execute();
            $result = $req->fetch();
            if ($result) {
                echo "<div class='warning'> Cette adresse email est déjà utilisée. </div>";
                echo "<script>setTimeout(function(){ document.querySelector('.warning').style.display = 'none'; }, 6000);</script>";
                return;
            }

            // Vérifier les deux mots de passe
            if ($_POST['password'] === $_POST['password-repeat']){
                $username = htmlspecialchars($_POST['username'], ENT_QUOTES); // Convertir les caractères spéciaux en entités HTML
                // Les vérifications ont été passées, on peut ajouter l'utilisateur à la base de données
                $pass = $_POST['password'];
                $hash = password_hash($pass, PASSWORD_BCRYPT);


                $sql = "INSERT INTO pop_user (pseudo, password, email) VALUES (:username, :password, :email)";
                $req = DB::getInstance()->prepare($sql);


                $req->bindParam(':username', $username);
                $req->bindParam(':password', $hash);
                $req->bindParam(':email', $user_email);
                $req->execute();

                $this->display('connect/login', [
                    'success' => "C'est ok"
                ]);

            }
            else{
                echo "<div class='warning'> Mot de passe non identique. </div>";
                echo "<script>setTimeout(function(){ document.querySelector('.warning').style.display = 'none'; }, 8000);</script>";
                $this->display('connect/login');
            }
        }
    }
}
