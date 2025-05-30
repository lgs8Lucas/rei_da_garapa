<?php

class ProductDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // INSERIR usando ProductModel
    public function insert(ProductsModel $product) {
        $sql = "INSERT INTO Products (Name, Quantity, Price, Image, Description) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $product->getName(),
            $product->getQuantity(),
            $product->getPrice(),
            $product->getImage(),
            $product->getDescription()
        ]);
    }

    // BUSCAR POR ID e retornar ProductModel
    public function getById($id) {
        $sql = "SELECT * FROM Products WHERE ID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new ProductsModel(
                $row['ID'],
                $row['Name'],
                $row['Quantity'],
                $row['Price'],
                $row['Image'],
                $row['Description']
            );
        }
        return null;
    }

    // BUSCAR TODOS, retorna array de ProductModel
    public function getAll() {
        $sql = "SELECT * FROM Products";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $products = [];

        foreach ($rows as $row) {
            $products[] = new ProductsModel(
                $row['ID'],
                $row['Name'],
                $row['Quantity'],
                $row['Price'],
                $row['Image'],
                $row['Description']
            );
        }

        return $products;
    }

    // ATUALIZAR usando ProductModel
    public function update($id, ProductsModel $product) {
        $sql = "UPDATE Products SET Name = ?, Quantity = ?, Price = ?, Image = ?, Description = ? WHERE ID = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $product->getName(),
            $product->getQuantity(),
            $product->getPrice(),
            $product->getImage(),
            $product->getDescription(),
            $id
        ]);
    }

    // DELETAR
    public function delete($id) {
        $sql = "DELETE FROM Products WHERE ID = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}