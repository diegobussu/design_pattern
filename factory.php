<?php

// Interface représentant le produit que le stock va gérer
interface Product
{
    public function getName(): string;
}

// Interface Product
class ProductInfos implements Product
{
    public function getName(): string
    {
        return "Iphone 15";
    }
}

// Interface du stock Apple
interface Apple
{
    public function InfosProduct(): Product;
}

// Implémentation concrète de la fabrique
class AppleStock implements Apple
{
    public function InfosProduct(): Product
    {
        return new ProductInfos();
    }
}
?>
