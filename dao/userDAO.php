<?php

class UserDAO
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert(UserModel $user)
    {
        $sql = "INSERT INTO Users (Name, Email, Password) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $user->getName(),
            $user->getEmail(),
            $user->getPassword()
        ]);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM Users WHERE ID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM Users";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, UserModel $user)
    {
        $sql = "UPDATE Users SET Name = ?, Email = ?, Password = ? WHERE ID = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $user->getName(),
            $user->getEmail(),
            $user->getPassword(),
            $id
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM Users WHERE ID = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function emailExists($email)
    {
        $sql = "SELECT COUNT(*) FROM Users WHERE Email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }

    public function getLastInsertedId()
    {
        return $this->pdo->lastInsertId();
    }

    public function authenticate($email, $password)
    {
        $sql = "SELECT ID, Name FROM Users WHERE Email = ? AND Password = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email, $password]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
