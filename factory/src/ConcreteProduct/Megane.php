<?php

namespace MPierron\ConcreteProduct;

use MPierron\Factory\CarParts;
use MPierron\Product\Car;

class Megane extends Car 
{
    public function assemble(): string
    {
        return "how the fuck is a megane assembled ?";
    }
}