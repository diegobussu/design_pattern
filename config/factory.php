<?php

// Interface représentant le produit que le stock va gérer
interface Product
{
    public function getId(): int;
    public function getName(): string;
    public function getReleaseYear(): string;
    public function getColor(): string;
    public function getCapacity(): int;
}

// Class for Iphone product
class Iphone implements Product
{
    private $id; // Nouveau champ pour stocker l'ID
    private $model;
    private $color;
    private $capacity;
    private $release_year;

    public function __construct($id, $model, $color, $capacity, $release_year)
    {
        $this->id = $id;
        $this->model = $model;
        $this->color = $color;
        $this->capacity = $capacity;
        $this->release_year = $release_year;
    }

    public function getId(): int // Implémentation de la méthode getId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return "Iphone " . $this->model;
    }

    public function getReleaseYear(): string
    {
        return "Année de sortie " . $this->release_year;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }
}

// Class for Ipad product
class Ipad implements Product
{
    private $id;
    private $model;
    private $color;
    private $capacity;
    private $release_year;

    public function __construct($id, $model, $color, $capacity, $release_year)
    {
        $this->id = $id;
        $this->model = $model;
        $this->color = $color;
        $this->capacity = $capacity;
        $this->release_year = $release_year;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return "Ipad " . $this->model;
    }

    public function getReleaseYear(): string
    {
        return "Année de sortie " . $this->release_year;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }
}

// Interface du stock Apple
interface Apple
{
    public function addProduct(string $model, string $color, int $capacity, string $releaseYear): void;
}

class iPhoneStock implements Apple
{
    private $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addProduct(string $model, string $color, int $capacity, string $releaseYear): void
    {
        $db = $this->pdo->prepare("INSERT INTO products (model, color, capacity, release_year) VALUES (:model, :color, :capacity, :releaseYear)");
    
        $db->bindParam(':model', $model);
        $db->bindParam(':color', $color);
        $db->bindParam(':capacity', $capacity);
        $db->bindParam(':releaseYear', $releaseYear);
    
        $db->execute();
    } 

    public function deleteProduct(int $productId): void
    {
        $db = $this->pdo->prepare("DELETE FROM products WHERE id = :id");
        $db->bindParam(':id', $productId);
        $db->execute();
    }    
}

class iPadStock implements Apple
{
    private $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addProduct(string $model, string $color, int $capacity, string $releaseYear): void
    {
        $db = $this->pdo->prepare("INSERT INTO products (model, color, capacity, release_year) VALUES (:model, :color, :capacity, :releaseYear)");
    
        $db->bindParam(':model', $model);
        $db->bindParam(':color', $color);
        $db->bindParam(':capacity', $capacity);
        $db->bindParam(':releaseYear', $releaseYear);
    
        $db->execute();
    }   
    
    public function deleteProduct(int $productId): void
    {
        $db = $this->pdo->prepare("DELETE FROM products WHERE id = :id");
        $db->bindParam(':id', $productId);
        $db->execute();
    }
    
}
?>
