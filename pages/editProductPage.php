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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = $controller->getById($id);
}else {
    header('Location: ./../pages/productsPage.php');
    exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cria um novo produto com os dados do formulário
    $tree = "./../img/";
    $extensao = strtolower(substr($_FILES['image']['name'], -4));
    $new_name = md5(time()) . $extensao;

    $imagePath = $tree . $new_name;
    if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
        $product = new ProductsModel(null, addslashes($_POST['name']), addslashes($_POST['quantity']), addslashes($_POST['price']), $imagePath, addslashes($_POST['description']));
        $controller->update($id, $product);
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
    <?php $mainView->showNavbar('insertProduct'); ?>
    <?php $productView->showProductForm($product); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>