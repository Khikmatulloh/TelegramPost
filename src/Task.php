<?php

declare(strict_types=1);
namespace App;

use PDO;
class Task
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo=DB::connect();
    }

    public function add(string $text): bool
    {
        $stmt   = $this->pdo->prepare("INSERT INTO posts (content) VALUES (:content)");
        $stmt->bindParam(':content', $text);
        
        return $stmt->execute();
        header("Location: /");
    }

    public function getAll(): false|array
    {
        return $this->pdo->query("SELECT * FROM posts")->fetchAll();
    }

   

    
}