<?php
require '../database/connection.php';
require_once './../view/mainView.php';
require_once './../view/userView.php';
require_once './../dao/userDAO.php';
require_once './../controller/userController.php';
require_once './../models/userModel.php';

$mainView = new MainView();
$userView = new UserView();
$dao = new UserDAO($pdo);
$model = new UserModel();


$controller = new UserController($userView, $dao, $model);
session_start();
//se já estiver logado, redireciona para a página inicial
if (isset($_SESSION['user_id'])) {
    header('Location: ./../pages/salesReportPage.php');
    exit();
}
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['pass'] ?? '';
    // Chama o método de registro do controlador
    $controller->login($email, $password);
}
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rei da Garapa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <?php $mainView->showNavbar('login'); ?>
    <?php $userView->showloginForm(); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>