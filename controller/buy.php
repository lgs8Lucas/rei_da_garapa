<?php

require_once '../dao/ProductDAO.php'; 
require_once '../dao/SalesDAO.php';
require_once '../database/connection.php';

$productDAO = new ProductDAO($pdo);
$salesDAO = new SalesDAO($pdo);

if (isset($_GET['id'], $_GET['quantity']) && is_numeric($_GET['id']) && is_numeric($_GET['quantity'])) {
    $productId = (int) $_GET['id'];
    $quantity = (int) $_GET['quantity'];

    $product = $productDAO->getById($productId);

    if ($product) {
       
        if ($product->getQuantity() >= $quantity && $quantity > 0) {
            
            $salesModel = new SalesModel($productId, $quantity, date('Y-m-d H:i:s'));
            
            if ($salesDAO->insert($salesModel)) {
                
                $productDAO->decreaseQuantity($productId, $quantity);

                echo "<script>
                        alert('Compra realizada com sucesso!');
                        window.location.href = 'index.php';
                      </script>";
            } else {
                echo "Erro ao registrar a venda.";
            }
        } else {
            echo "Quantidade inválida ou estoque insuficiente.";
        }
        exit;
    } else {
        echo "Produto não encontrado.";
    }
} else {
    echo "ID ou quantidade inválidos.";
}