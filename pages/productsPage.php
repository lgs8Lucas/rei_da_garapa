<?php
require '../database/connection.php';
require_once './../view/mainView.php';
require_once './../dao/productDAO.php';
require_once './../models/productsModel.php';
require_once './../view/productView.php';
require_once './../controller/productController.php';



$mainView = new MainView();
$productView = new ProductView();
$dao = new ProductDAO($pdo);
$model = null;

$controller = new ProductController($productView, $dao);

session_start();
//se já estiver logado, redireciona para a página inicial
if (!isset($_SESSION['user_id'])) {
    header('Location: ./../pages/loginPage.php');
    exit();
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if (is_numeric($id)) {
        $controller->delete($id);
    }
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
    <?php $mainView->showNavbar('products'); ?>
    <?php $controller->listProducts(); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>