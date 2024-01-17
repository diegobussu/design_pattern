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

// Interface de l'observateur
interface StockObserver
{
    public function productAdded(Product $product);
    public function productDeleted(int $productId);
    public function stockUpdated(int $productId, int $newStock);
}

class Stock implements Apple
{
    private $pdo;
    private $observers = [];

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addObserver(StockObserver $observer)
    {
        $this->observers[] = $observer;
    }

    private function notifyProductAdded(Product $product)
    {
        foreach ($this->observers as $observer) {
            $observer->productAdded($product);
        }
    }

    private function notifyProductDeleted(int $productId)
    {
        foreach ($this->observers as $observer) {
            $observer->productDeleted($productId);
        }
    }

    private function notifyStockUpdated(int $productId, int $newStock)
    {
        foreach ($this->observers as $observer) {
            $observer->stockUpdated($productId, $newStock);
        }
    }

    public function addProduct(string $model, string $color, int $capacity, string $releaseYear, int $in_stock): void
    {
        $db = $this->pdo->prepare("INSERT INTO products (model, color, capacity, release_year, in_stock) VALUES (:model, :color, :capacity, :releaseYear, :in_stock)");
    
        $db->execute([':model' => $model, ':color' => $color, ':capacity' => $capacity, ':releaseYear' => $releaseYear, ':in_stock' => $in_stock]);

        $productId = $this->pdo->lastInsertId();
        $addedProduct = new AppleProduct($productId, $model, $color, $capacity, $releaseYear, $in_stock);
        $this->notifyProductAdded($addedProduct);
    }  

    public function deleteProduct(int $productId): void
    {
        $db = $this->pdo->prepare("DELETE FROM products WHERE id = :id");
        $db->execute([':id' => $productId]);

        $this->notifyProductDeleted($productId);
    }

    public function addOneToStock(int $productId): void
    {
        $db = $this->pdo->prepare("UPDATE products SET in_stock = in_stock + 1 WHERE id = :id");

        $db->execute([':id' => $productId]);

        $newStock = $this->getStockCount($productId);
        $this->notifyStockUpdated($productId, $newStock);
    }

    public function removeOneToStock(int $productId): void
    {
        $db = $this->pdo->prepare("UPDATE products SET in_stock = in_stock - 1 WHERE id = :id");

        $db->execute([':id' => $productId]);

        $newStock = $this->getStockCount($productId);
        $this->notifyStockUpdated($productId, $newStock);
    }

    private function getStockCount(int $productId): int
    {
        $db = $this->pdo->prepare("SELECT in_stock FROM products WHERE id = :id");
        $db->execute([':id' => $productId]);
        return (int) $db->fetchColumn();
    } 
}

class Logs implements StockObserver
{
    private $logFile = __DIR__ . '/../config/logs/logs.txt';

    public function productAdded(Product $product)
    {
        $logMessage = "Produit ajouté : {$product->getName()} (ID: {$product->getId()})\n";
        $this->writeToLog($logMessage);
    }

    public function productDeleted(int $productId)
    {
        $logMessage = "Produit n°$productId supprimé !\n";
        $this->writeToLog($logMessage);
    }

    public function stockUpdated(int $productId, int $newStock)
    {
        $logMessage = "Stock mis à jour pour le produit n°$productId. Nouveau stock : $newStock\n";
        $this->writeToLog($logMessage);
    }

    private function writeToLog($message)
    {
        file_put_contents($this->logFile, $message, FILE_APPEND);
    }
}

// Interface incompatible (produits android par exemple)
interface IncompatibleProduct
{
    public function getId(): int;
    public function getName(): string;
    public function getReleaseYear(): string;
    public function getColor(): string;
    public function getCapacity(): int;
    public function getInStock(): int;
}

// Adapter pour convertir AppleProduct en IncompatibleProduct
class AppleProductIncompatibleAdapter implements IncompatibleProduct
{
    private $appleProduct;

    public function __construct(AppleProduct $appleProduct)
    {
        $this->appleProduct = $appleProduct;
    }

    public function getId(): int
    {
        return $this->appleProduct->getId();
    }

    public function getName(): string
    {
        return $this->appleProduct->getName();
    }

    public function getReleaseYear(): string
    {
        return $this->appleProduct->getReleaseYear();
    }

    public function getColor(): string
    {
        return $this->appleProduct->getColor();
    }

    public function getCapacity(): int
    {
        return $this->appleProduct->getCapacity();
    }

    public function getInStock(): int
    {
        return $this->appleProduct->getInStock();
    }
}

?>
