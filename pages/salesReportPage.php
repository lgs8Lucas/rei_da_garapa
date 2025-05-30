<?php
require_once './../database/connection.php';
require_once './../dao/salesDAO.php';
require_once './../dao/productDAO.php';
require_once './../view/mainView.php';

$salesDAO = new SalesDAO($pdo);
$productDAO = new ProductDAO($pdo);

$mainView = new mainView();

// Pega todas as vendas
$sales = $salesDAO->getAll();

// Processa dados para o gráfico: Contagem de vendas por Produto
$productSalesCount = [];

foreach ($sales as $sale) {
    $productId = $sale->getProductId();
    if (!isset($productSalesCount[$productId])) {
        $productSalesCount[$productId] = 0;
    }
    $productSalesCount[$productId]++;
}

// Busca nomes dos produtos
$productNames = [];
foreach (array_keys($productSalesCount) as $productId) {
    $product = $productDAO->getById($productId);
    $productNames[$productId] = $product ? $product->getName() : "Produto ID $productId";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Extrato de Vendas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        #chartContainer { width: 80%; margin: auto; }
    </style>
</head>
<body>
<?php $mainView->showNavbar('salesReport'); ?>

<h2>Extrato de Vendas</h2>

<table>
    <tr>
        <th>ID da Venda</th>
        <th>ID do Produto</th>
        <th>Data da Venda</th>
    </tr>
    <?php 
    $cont = 0;
    foreach ($sales as $sale): 
    $cont++?>
    <tr>
        <td><?= htmlspecialchars($cont) ?></td>
        <td><?= htmlspecialchars($sale->getProductId()) ?></td>
        <td><?= htmlspecialchars($sale->getTime()) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<h2>Gráfico de Vendas por Produto</h2>
<div id="chartContainer">
    <canvas id="salesChart"></canvas>
</div>

<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_values($productNames)) ?>,
            datasets: [{
                label: 'Quantidade de Vendas',
                data: <?= json_encode(array_values($productSalesCount)) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
