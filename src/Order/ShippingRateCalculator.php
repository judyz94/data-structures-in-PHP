<?php

namespace src\Order;

class ShippingRateCalculator
{
    public function calculateRate(array $shipmentDetails): float
    {
        $url = 'https://ushippingrate.com/calculate-shipping';
        $options = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/json',
                'content' => json_encode($shipmentDetails),
            ],
        ];
        $response = 10; //file_get_contents($url, false, $optitons);

        $shippingRate = json_decode($response);
        return (float) $shippingRate;
    }
}