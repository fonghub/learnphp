<?php
namespace Task\Bll\Php7NewFeatures\ErrorException;

class MathOperations
{
    public function index()
    {
        try {
            $value = 10 % 0;
            return "result = ".$value;
        } catch (\DivisionByZeroError $er) {
            return $er->getMessage();
        }
    }
}