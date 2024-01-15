<?php

// Interface représentant le produit que la fabrique va créer
interface Product
{
    public function getName(): string;
}

// Implémentation concrète de l'interface Product
class ConcreteProduct implements Product
{
    public function getName(): string
    {
        return "Product";
    }
}

// Interface de la fabrique
interface Factory
{
    public function createProduct(): Product;
}

// Implémentation concrète de la fabrique
class ConcreteFactory implements Factory
{
    public function createProduct(): Product
    {
        return new ConcreteProduct();
    }
}

// Utilisation de la fabrique
$factory = new ConcreteFactory();
$product = $factory->createProduct();

echo $product->getName(); // Affiche "Concrete Product"

?>
