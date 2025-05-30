<?php
require_once './../dao/userDAO.php';
require_once './../view/userView.php';
require_once './../view/mainView.php';

class UserController
{
    private $view;
    private $dao;
    private $model;
    private $mainView;

    public function __construct($view, $dao, $model)
    {
        $this->view = $view;
        $this->dao = $dao;
        $this->model = $model;
        $this->mainView = new MainView();
    }

    public function register($name, $email, $password, $confirmPassword)
    {
        if ($password !== $confirmPassword) {
            $this->mainView->showAllert("As senhas não coincidem.");
            return;
        }
        if (empty($name) || empty($email) || empty($password)) {
            $this->mainView->showAllert("Todos os campos são obrigatórios.");
            return;
        }
        // Check if email already exists
        if ($this->dao->emailExists($email)) {
            $this->mainView->showAllert("Email já cadastrado.");
            return;
        }
        // Create new user
        $this->model = new UserModel();
        $this->model->setName($name);
        $this->model->setEmail($email);
        $this->model->setPassword($password);
        if ($this->dao->insert($this->model)) {
            // Redirect
            // Save in session
            session_start();
            $_SESSION['user_id'] = $this->dao->getLastInsertedId(); // Assuming getLastInsertId() returns the last inserted user ID
            $_SESSION['user_name'] = $name; // Save the user's name in session
            $this->mainView->showAllert("Usuário cadastrado com sucesso!");
            header('Location: ./../pages/salesReportPage.php');
            exit();
        } else {
            $this->mainView->showAllert("Erro ao cadastrar usuário. Tente novamente.");
        }
    }
    public function login($email, $password)
    {
        if (empty($email) || empty($password)) {
            $this->mainView->showAllert("Todos os campos são obrigatórios.");
            return;
        }

        $u = $this->dao->authenticate($email, $password);

        if ($u) {
            // Save in session
            session_start();
            $_SESSION['user_id'] = $u['id']; // Assuming 'id' is the user ID in the database
            $_SESSION['user_name'] = $u['name']; // Assuming 'name' is the user's name in the database

            $this->mainView->showAllert("Login realizado com sucesso!");
            header('Location: ./../pages/salesReportPage.php');
        } else {
            $this->mainView->showAllert("Email ou senha incorretos.");
        }
    }
}
