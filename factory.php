<?php

// Interface représentant le produit que le stock va gérer
interface Product
{
    public function getName(): string;
}

// Class for Iphone product
class Iphone implements Product
{
    public function getName(): string
    {
        return "Iphone";
    }
}

// Class for Iphone product
class Ipad implements Product
{
    public function getName(): string
    {
        return "Ipad";
    }
}

// Interface du stock Apple
interface Apple
{
    public function InfosProduct(): Product;
}

class iPhoneStock implements Apple
{
    public function InfosProduct(): Product
    {
        return new Iphone();
    }
}

class iPadStock implements Apple
{
    public function InfosProduct(): Product
    {
        return new Ipad();
    }
}
?>
