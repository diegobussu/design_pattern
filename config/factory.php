<?php

// Interface représentant le produit que le stock va gérer
interface Product
{
    public function getId(): int;
    public function getName(): string;
    public function getReleaseYear(): string;
    public function getColor(): string;
    public function getCapacity(): int;
    public function getInStock(): int;
}

// Class for Iphone product
class AppleProduct implements Product
{
    private $id;
    private $model;
    private $color;
    private $capacity;
    private $release_year;
    private $in_stock;

    public function __construct($id, $model, $color, $capacity, $release_year, $in_stock)
    {
        $this->id = $id;
        $this->model = $model;
        $this->color = $color;
        $this->capacity = $capacity;
        $this->release_year = $release_year;
        $this->in_stock = $in_stock;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->model;
    }

    public function getReleaseYear(): string
    {
        return $this->release_year;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function getInStock(): int
    {
        return $this->in_stock;
    }
}

// Interface du stock Apple
interface Apple
{
    public function addProduct(string $model, string $color, int $capacity, string $releaseYear, int $in_stock): void;
    public function deleteProduct(int $productId): void;
    public function addOneToStock(int $productId): void;
    public function removeOneToStock(int $productId): void;
}

class AppleStock implements Apple
{
    private $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addProduct(string $model, string $color, int $capacity, string $releaseYear, int $in_stock): void
    {
        $db = $this->pdo->prepare("INSERT INTO products (model, color, capacity, release_year, in_stock) VALUES (:model, :color, :capacity, :releaseYear, :in_stock)");
    
        $db->execute([':model' => $model, ':color' => $color, ':capacity' => $capacity, ':releaseYear' => $releaseYear, ':in_stock' => $in_stock]);
    }  

    public function deleteProduct(int $productId): void
    {
        $db = $this->pdo->prepare("DELETE FROM products WHERE id = :id");
        $db->execute([':id' => $productId]);
    }

    public function addOneToStock(int $productId): void
    {
        $db = $this->pdo->prepare("UPDATE products SET in_stock = in_stock + 1 WHERE id = :id");

        $db->execute([':id' => $productId]);
    }

    public function removeOneToStock(int $productId): void
    {
        $db = $this->pdo->prepare("UPDATE products SET in_stock = in_stock - 1 WHERE id = :id");

        $db->execute([':id' => $productId]);
    }
      
}
?>
