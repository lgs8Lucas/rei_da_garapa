<?php
require_once './dao/productDAO.php';
require_once './database/connection.php';

$userDAO = new UserDAO($pdo);
$productDAO = new ProductDAO($pdo);
$salesDAO = new SalesDAO($pdo);

$productsList = [];
$productsList = $productDAO->getAll();
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
  <h1>Rei da Garapa 🧋🧈</h1>
   <div class="container">
    <div class="row">
      <?php foreach ($productsList as $product): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="<?= htmlspecialchars($product->getImage()) ?>" class="card-img-top" alt="<?= htmlspecialchars($product->getName()) ?>">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title"><?= htmlspecialchars($product->getName()) ?></h5>
              <p class="card-text">
                <strong>Preço:</strong> R$ <?= number_format($product->getPrice(), 2, ',', '.') ?><br>
                <strong>Quantidade:</strong> <?= htmlspecialchars($product->getQuantity()) ?>
              </p>

              <a class="btn btn-link p-0 mb-2" data-bs-toggle="collapse" href="#desc<?= $product->getId() ?>" role="button" aria-expanded="false" aria-controls="desc<?= $product->getId() ?>">
                Ver descrição
              </a>

              <div class="collapse" id="desc<?= $product->getId() ?>">
                <p class="card-text"><?= htmlspecialchars($product->getDescription()) ?></p>
              </div>

              <div class="mt-auto d-flex justify-content-end">
                <a href="comprar.php?id=<?= $product->getId() ?>" class="btn btn-success">Comprar</a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>