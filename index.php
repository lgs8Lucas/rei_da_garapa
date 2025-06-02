<?php
require_once './dao/ProductDAO.php';
require_once './models/productsModel.php';
require_once './database/connection.php';

$productDAO = new ProductDAO($pdo);
$productsList = $productDAO->getAll();
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Totem de Pedidos - Rei da Garapa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container py-4">
    <h1 class="text-center text-primary text-dark mb-5 fw-bold">🍹 Totem - Rei da Garapa</h1>
    
    <div class="row justify-content-center">
      <?php foreach ($productsList as $product): ?>
        <div class="col-12 col-md-6 col-lg-4 mb-4" style="width: 400px; height: 500px;">
          <div class="card h-100">
            <?php
              $img = $product->getImage();
              $img = str_replace("./../", "", $img);

              echo '<img
                        class="card-img-top"
                        src="' . htmlspecialchars($img) . '"
                        alt="' . htmlspecialchars($product->getName()) . '">';
            ?>
            <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($product->getName()) ?></h5>
            <p class="card-text"><?= htmlspecialchars($product->getDescription()) ?></p>
            <p class="card-text"><?= htmlspecialchars($product->getQuantity()) ?> em estoque</p>
            <p class="card-text"><strong>Preço:</strong> R$ <?= number_format($product->getPrice(), 2, ',', '.') ?></p>
          </div>
          <div class="card-footer border-top-0 bg-white">
            <form action="controller/buy.php" method="GET" class="d-flex gap-2">
              <input type="hidden" name="id" value="<?= $product->getId() ?>">
              <input 
                type="number" 
                name="quantity" 
                value="1" 
                min="1" 
                max="<?= htmlspecialchars($product->getQuantity()) ?>" 
                class="form-control" 
                style="max-width: 80px;"
                required
              >
              <button type="submit" class="btn btn-success py-3 fs-5 flex-grow-1">🛒 Comprar</button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

