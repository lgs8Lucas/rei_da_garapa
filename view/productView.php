<?php
require_once './../models/ProductsModel.php';

class ProductView
{
    public function showProductForm($product = null)
    {
        $name = $product ? htmlspecialchars($product->getName()) : '';
        $quantity = $product ? htmlspecialchars($product->getQuantity()) : '';
        $price = $product ? htmlspecialchars($product->getPrice()) : '';
        $image = $product ? htmlspecialchars($product->getImage()) : '';
        $description = $product ? htmlspecialchars($product->getDescription()) : '';

        $btnText = $product ? 'Atualizar Produto' : 'Adicionar Produto';

        echo '
        <form method="POST" enctype="multipart/form-data" class="container mt-3"> 
            <div class="mb-3">
                <label for="name" class="form-label">Nome do Produto</label>
                <input type="text" class="form-control" id="name" name="name" value="' . $name . '" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantidade</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="' . $quantity . '" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Preço</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="' . $price . '" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Imagem</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control" id="description" name="description">' . $description . '</textarea>
            </div>
            <button type="submit" class="btn btn-primary">'.$btnText.'</button>
        </form>';
    }

    public function showProductsList($products)
    {
        echo '<div class="container mt-3">';
        echo '<h2>Lista de Produtos</h2>';
        echo '<table class="table table-striped">';
        echo '<thead><tr><th>ID</th><th>Nome</th><th>Quantidade</th><th>Preço</th><th>Imagem</th><th>Ações</th></tr></thead>';
        echo '<tbody>';

        foreach ($products as $product) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($product->getId()) . '</td>';
            echo '<td>' . htmlspecialchars($product->getName()) . '</td>';
            echo '<td>' . htmlspecialchars($product->getQuantity()) . '</td>';
            echo '<td>R$ ' . number_format($product->getPrice(), 2, ',', '.') . '</td>';
            echo '<td><img src="' . htmlspecialchars($product->getImage()) . '" alt="' . htmlspecialchars($product->getName()) . '" style="width: 50px; height: 50px;"></td>';
            echo '<td>
                    <a href="./../pages/editProductPage.php?id=' . $product->getId() . '" class="btn btn-warning">Editar</a>
                    <form method="GET" style="display:inline;">
                        <input type="hidden" name="delete" value="' . $product->getId() . '">
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                  </td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    }
}
