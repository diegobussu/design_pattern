<?php

// Interface représentant le produit que le stock va gérer
interface Product
{
    public function getName(): string;
}

// Class for Iphone product
class Iphone implements Product
{
    private $model;

    public function __construct ($model) {
        $this->model = $model;
    }

    public function getName(): string
    {
        return "Iphone" . $this->model;
    }
}

// Class for Iphone product
class Ipad implements Product
{
    private $model;

    public function __construct ($model) {
        $this->model = $model;
    }

    public function getName(): string
    {
        return "Iphone" . $this->model;
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

    public function __construct($model) {
        $this->model = $model;
    }

    public function InfosProduct(): Product
    {
        return new Iphone($this->model);
    }
}

class iPadStock implements Apple
{
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function InfosProduct(): Product
    {
        return new Ipad($this->model);
    }
}
?>
