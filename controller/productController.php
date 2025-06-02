<?php
require_once './../models/productsModel.php';
require_once './../dao/productDAO.php';
require_once './../database/connection.php';
require_once './../view/mainView.php';


class ProductController
{

    private $mainView;
    private $dao;
    private $view;

    public function __construct($view, $dao)
    {
        $this->dao = $dao;
        $this->mainView = new MainView();
        $this->view = $view;
    }

    // Inserir usando o product Model
    public function insert($product)
    {
        if ($product instanceof ProductsModel) {
            if ($this->dao->insert($product)) {
                $this->mainView->showAllert('Produto adicionado com sucesso!');
                echo "<script>window.location.href = './../pages/productsPage.php';</script>";
            } else {
                $this->mainView->showAllert('Erro ao adicionar produto.');
            }
        }
    }


    public function getById($id)
    {
        return $this->dao->getById($id);
    }

    public function listProducts()
    {
        $products = $this->dao->getAll();
        $this->view->showProductsList($products);
    }


    // ATUALIZAR usando ProductModel
    public function update($id, $product)
    {
        if ($product instanceof ProductsModel) {
            if ($this->dao->update($id, $product)) {
                $this->mainView->showAllert('Produto editado com sucesso!');
                echo "<script>window.location.href = './../pages/productsPage.php';</script>";
            } else {
                $this->mainView->showAllert('Erro ao editar produto.');
            }
        }
    }

    // DELETAR
    public function delete($id)
    {
        if ($this->dao->delete($id)) {
            $this->mainView->showAllert('Produto excluído com sucesso!');
        } else {
            $this->mainView->showAllert('Erro ao excluir produto.');
        }
    }

    public function decreaseQuantity($productId, $amount)
    {
        // Pega o produto pelo ID
        $product = $this->dao->getById($productId);

        if (!$product) {
            $this->mainView->showAllert('Produto não encontrado!');
            return false;
        }

        // Verifica se a quantidade é suficiente
        $currentQuantity = $product->getQuantity();
        if ($currentQuantity < $amount) {
            $this->mainView->showAllert('Quantidade insuficiente em estoque!');
            return false;
        }

        // Atualiza a quantidade
        $newQuantity = $currentQuantity - $amount;
        $product->setQuantity($newQuantity);

        // Atualiza no banco
        if ($this->dao->update($productId, $product)) {
            $this->mainView->showAllert('Quantidade atualizada com sucesso!');
            return true;
        } else {
            $this->mainView->showAllert('Erro ao atualizar quantidade.');
            return false;
        }
    }

    public function getImageById($id)
{
    return $this->dao->getImageById($id);
}

}
