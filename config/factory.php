<?php

// Interface représentant le produit que le stock va gérer
interface Product
{
    public function getName(): string;
    public function getReleaseYear(): string;
    public function getColor(): string;
    public function getCapacity(): int;
}

// Class for Iphone product
class Iphone implements Product
{
    private $model;
    private $color;
    private $capacity;
    private $release_year;

    public function __construct($model, $color, $capacity, $release_year)
    {
        $this->model = $model;
        $this->color = $color;
        $this->capacity = $capacity;
        $this->release_year = $release_year;
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
    private $model;
    private $color;
    private $capacity;
    private $release_year;

    public function __construct($model, $color, $capacity, $release_year)
    {
        $this->model = $model;
        $this->color = $color;
        $this->capacity = $capacity;
        $this->release_year = $release_year;
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
    public function updateProduct(string $productName, Product $updatedProduct): void;
    public function deleteProduct(string $productName): void;
}

class iPhoneStock implements Apple
{
    private $products = [];

    public function addProduct(string $model, string $color, int $capacity, string $releaseYear): void
    {
        $product = new Iphone($model, $color, $capacity, $releaseYear);
        $this->products[$product->getName()] = $product;
    }

    public function getProduct(string $productName): ?Product
    {
        return $this->products[$productName] ?? null;
    }

    public function updateProduct(string $productName, Product $updatedProduct): void
    {
        if (isset($this->products[$productName])) {
            $this->products[$productName] = $updatedProduct;
        }
    }

    public function deleteProduct(string $productName): void
    {
        unset($this->products[$productName]);
    }
}

class iPadStock implements Apple
{
    private $products = [];

    public function addProduct(string $model, string $color, int $capacity, string $releaseYear): void
    {
        $product = new Ipad($model, $color, $capacity, $releaseYear);
        $this->products[$product->getName()] = $product;
    }

    public function getProduct(string $productName): ?Product
    {
        return $this->products[$productName] ?? null;
    }

    public function updateProduct(string $productName, Product $updatedProduct): void
    {
        if (isset($this->products[$productName])) {
            $this->products[$productName] = $updatedProduct;
        }
    }

    public function deleteProduct(string $productName): void
    {
        unset($this->products[$productName]);
    }
}

?>
