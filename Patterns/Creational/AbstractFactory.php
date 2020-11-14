﻿<?php
class Config {

    public static $factory = 1;
}

interface Product {

    public function getName();
}

abstract class AbstractFactory {

    /**
     * Get 1 or 2 Factory
     *
     * @return Factory
     * @throws Exception
     */
    public static function getFactory()
    {
        switch (Config::$factory) {
            case 1:
                return new FirstFactory();
            case 2:
                return new SecondFactory();
        }
        throw new Exception('Bad config');
    }

    abstract public function getProduct();
}

//--------------------------------------------------- 1
class FirstFactory extends AbstractFactory
{

    public function getProduct()
    {
        return new FirstProduct();
    }
}

// Product of FirstFactory
class FirstProduct implements Product
{

    public function getName() {

        return 'The product from the first factory';
    }
}

//--------------------------------------------------- 2
class SecondFactory extends AbstractFactory 
{
    public function getProduct()  {
        return new SecondProduct();
    }
}

// Product of SecondFactory
class SecondProduct implements Product
{

    public function getName() {

        return 'The product from second factory';
    }
}

//--------------------------------------------------- 

$firstProduct = AbstractFactory::getFactory()->getProduct();
Config::$factory = 2;
$secondProduct = AbstractFactory::getFactory()->getProduct();

print_r($firstProduct->getName());
// The first product from the first factory
print_r($secondProduct->getName());
// Second product from second factory