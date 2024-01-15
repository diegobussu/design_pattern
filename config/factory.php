<?php

// Interface représentant le produit que le stock va gérer
interface Product
{
    public function getName(): string;
    public function getReleaseYear(): string;
}

// Class for Iphone product
class Iphone implements Product
{
    private $model;
    private $release_year;

    public function __construct ($model, $release_year) {
        $this->model = $model;
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
}

// Class for Iphone product
class Ipad implements Product
{
    private $model;
    private $release_year;

    public function __construct ($model, $release_year) {
        $this->model = $model;
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
}

// Interface du stock Apple
interface Apple
{
    public function InfosProduct(): Product;
}

class iPhoneStock implements Apple
{
    private $model;
    private $release_year;

    public function __construct ($model, $release_year) {
        $this->model = $model;
        $this->release_year = $release_year;
    }

    public function InfosProduct(): Product
    {
        return new Iphone($this->model, $this->release_year);
    }
}

class iPadStock implements Apple
{
    private $model;
    private $release_year;

    public function __construct ($model, $release_year) {
        $this->model = $model;
        $this->release_year = $release_year;
    }

    public function InfosProduct(): Product
    {
        return new Ipad($this->model, $this->release_year);
    }
}
?>
