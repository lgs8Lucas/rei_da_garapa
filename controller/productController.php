<?php
require_once './../models/productsModel.php';
require_once 'models/productDAO.php'; 
require_once 'connection.php'; 

class ProductController{

    private $dao;

    public function __construct($connection)
    {   
        $this->dao = new ProductDAO($connection);
    }

     // Inserir usando o product Model
    public function insert($product) {
         if(
            isset($_POST['name'], $_POST['quantity'], $_POST['price'], $_FILES['image'], $_POST['description']) &&
            !empty($_POST['name']) && 
            !empty($_POST['quantity']) && 
            !empty($_POST['price']) &&
            !empty($_POST['description']))
            {

                $name = addslashes($_POST['name']);
                $quantity = addslashes($_POST['quantity']);
                $price = addslashes($_POST['price']);
                $description = addslashes($_POST['description']);

                $tree = "img/";
                
                $extensao = strtolower(substr($_FILES['image']['name'], -4));
                $new_name = md5(time()) . $extensao;

                if(move_uploaded_file($_FILES['image']['tmp_name'], $tree . $new_name)){

                    $imagePath = $tree . $new_name;

                    $product = new ProductsModel($name, $quantity, $price, $imagePath, $description);

                    return $this->dao->insert($product);

                }else {
                    return 0;
                }
            }
    }


    public function getById($id) {
        return $this->dao->getById($id);
    }

    public function getAll() {
        return $this->dao->getAll();
    }


     // ATUALIZAR usando ProductModel
    public function update($id, $product) {
         if (
            isset($_POST['name'], $_POST['quantity'], $_POST['price'], $_FILES['image'], $_POST['description']) &&
            !empty($_POST['name']) && 
            !empty($_POST['quantity']) && 
            !empty($_POST['price']) &&
            !empty($_POST['description']))
            {

                $name = addslashes($_POST['name']);
                $quantity = addslashes($_POST['quantity']);
                $price = addslashes($_POST['price']);
                $description = addslashes($_POST['description']);

                $tree = "img/";
                
                $extensao = strtolower(substr($_FILES['image']['name'], -4));
                $new_name = md5(time()) . $extensao;

                if(move_uploaded_file($_FILES['image']['tmp_name'], $tree . $new_name)){

                    $imagePath = $tree . $new_name;

                    $product = new ProductsModel($name, $quantity, $price, $imagePath, $description);

                    return $this->dao->update($id, $product);

                }else {
                    return 0;
                }
            }
    }

    // DELETAR
    public function delete($id) {
       return $this->dao->delete($id);
    }

}

?>



