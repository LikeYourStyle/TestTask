<?php

class LoginController extends Controller
{

    private $pageTpl = "/views/login.tpl.php";

    public function __construct()
    {
        $this->model = new LoginModel();
        $this->view = new View();
    }

    public function index()
    {
        $this->pageData['title'] = "Вход в админ панель";
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $login = strip_tags($_POST['login']);
            $password = md5(strip_tags($_POST['password']));

            $this->login($login, $password);
        }
        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function login($login, $pass)
    {
        if ($this->model->checkUser($login, $pass)) {
            $_SESSION['user'] = $login;
            header("Location: /");
        } else {
            $this->pageData['loginError'] = "Неверный логин или пароль";
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: /");
    }

}
