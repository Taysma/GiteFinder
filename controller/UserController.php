<?php
class UserController extends Controller {

    public function register(){
        global $router;
        $model = new UserModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $rawPass = $_POST['password'];
            $password = password_hash($rawPass, PASSWORD_DEFAULT);
            $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);

            $user = new User([
                'username' => $username,
                'password' => $password,
                'email' => $email
            ]);

            $model->createUser($user);
            header('Location: ' . $router->generate('login'));
        } else {
            echo self::getRender('connect.html.twig', []);
        }
    }

    public function login(){
        if (!$_POST) {
            echo self::getRender('connect.html.twig', []);
        } else {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $model = new UserModel();
            $user = $model->getUserByEmail($email);

            if ($user) {
                if (password_verify($password, $user->getPassword())) {
                    $_SESSION['id'] = $user->getId_user();
                    $_SESSION['username'] = $user->getFirstname();
                    $_SESSION['connect'] = true;

                global $router;
                header('Location: ' . $router->generate('dashboardUser')); // add condition "if" pour les 3 routes si role match host/guest/admin
                exit();
                } else {
                    echo 'Email / password incorrect !';
                }
            } else {
                $message = "Veillez remplir tout les champs";
                echo self::getRender('connect.html.twig', ['message' => $message]);
            }
        }
    }

    public function logout(){
        session_start();
        session_destroy();

        global $router;
        header('Location: ' . $router->generate('home'));
        exit();
    }
}