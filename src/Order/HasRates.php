<?php

namespace src\Order;

trait HasRates
{
    private function getShippingCost(): float
    {
        return (new ShippingRateCalculator())->calculateRate(['state', 'city', 'zip']);
    }

    private function getTaxRate(): float
    {
        return 0.07;
    }
}