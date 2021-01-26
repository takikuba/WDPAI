<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__ .'/../repository/UserRepository.php';

class SecurityController extends AppController {

    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login()
    {
        $this->requireLogin(false);

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = hash('sha512', $password);


        $user = $this->userRepository->getUser($email);


        if (!$user) {
            return $this->render('login', ['messages' => ['User not found!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }
        $_SESSION[SESSION_KEY_USER_LOGGED] = true;
        $_SESSION[SESSION_KEY_USER_EMAIL] = $user->getEmail();
        $_SESSION[SESSION_KEY_USER_ID] = $user->getId();

        $url = "http://$_SERVER[HTTP_HOST]";

        if($user->getId() == 0 ){
            $this->admin();
        }

        header("Location: {$url}/projects");
    }

    public function register()
    {
        $this->requireLogin(false);
        if (!$this->isPost()) {
            return $this->render('register');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $description = "Hello";
        $id = $this->userRepository->getId($email);

        if ($password !== $confirmedPassword) {
            return $this->render('register', ['messages' => ['Please provide proper password']]);
        }

        $user = new User($email, hash('sha512', $password), $name, $surname, $description, $id);

        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
    }


    public function logout() {
        $this->requireLogin();
        if (!$this->isPost()) {
            return $this->render('profile');
        }

        $_SESSION[SESSION_KEY_USER_LOGGED] = false;
        session_unset();
        session_destroy();

        return $this->render('login', ['messages' => ['You\'ve succesfully logged out!']]);
    }

    public function admin(){
        $this->requireLogin();

        $users = $this->userRepository->getUsers();

        $user = $this->userRepository->getUser('admin@admin.admin');

        return $this->render('admin', ['users'=> $users]);

    }

    public function removeUser(){
        $this->userRepository->rmUser($_POST['rm']);
        $this->admin();
    }


}