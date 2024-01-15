<?php

// Interface représentant le produit que le stock va gérer
interface Product
{
    public function getId(): int; // Nouvelle méthode pour obtenir l'ID
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
    public function getProduct(string $productName): ?Product;
    public function updateProduct(int $productId, Product $updatedProduct): void;
    public function deleteProduct(int $productId): void;
    public function getProductById(int $productId): ?Product;
}

class iPhoneStock implements Apple
{
    private $products = [];

    public function addProduct(string $model, string $color, int $capacity, string $releaseYear): void
    {
        // Génération d'un ID unique pour chaque produit
        $id = uniqid();
        $product = new Iphone($id, $model, $color, $capacity, $releaseYear);
        $this->products[$product->getId()] = $product;
    }

    public function getProduct(string $productName): ?Product
    {
        foreach ($this->products as $product) {
            if ($product->getName() === $productName) {
                return $product;
            }
        }
        return null;
    }

    public function updateProduct(int $productId, Product $updatedProduct): void
    {
        if (isset($this->products[$productId])) {
            $this->products[$productId] = $updatedProduct;
        }
    }

    public function deleteProduct(int $productId): void
    {
        unset($this->products[$productId]);
    }

    public function getProductById(int $productId): ?Product
    {
        return $this->products[$productId] ?? null;
    }
}

class iPadStock implements Apple
{
    private $products = [];

    public function addProduct(string $model, string $color, int $capacity, string $releaseYear): void
    {
        // Génération d'un ID unique pour chaque produit
        $id = uniqid();
        $product = new Ipad($id, $model, $color, $capacity, $releaseYear);
        $this->products[$product->getId()] = $product;
    }

    public function getProduct(string $productName): ?Product
    {
        foreach ($this->products as $product) {
            if ($product->getName() === $productName) {
                return $product;
            }
        }
        return null;
    }

    public function updateProduct(int $productId, Product $updatedProduct): void
    {
        if (isset($this->products[$productId])) {
            $this->products[$productId] = $updatedProduct;
        }
    }

    public function deleteProduct(int $productId): void
    {
        unset($this->products[$productId]);
    }

    public function getProductById(int $productId): ?Product
    {
        return $this->products[$productId] ?? null;
    }
}
?>
