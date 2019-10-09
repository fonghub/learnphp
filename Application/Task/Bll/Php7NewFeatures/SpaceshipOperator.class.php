<?php
namespace Task\Bll\Php7NewFeatures;

/**
 * 太空船操作符 "<=>"
 */
class SpaceshipOperator
{
    public function index($a,$b): int
    {
        return $a <=> $b;
    }
}