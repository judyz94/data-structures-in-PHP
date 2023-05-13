<?php

namespace src\Order;

class Item
{
    private string $id;
    private string $name;
    private int $quantity;
    private float $price;

    use HasRates;

    public function __construct(string $id, string $name, int $quantity, float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getItemCost(): float
    {
        $subtotal = $this->getQuantity() * $this->getPrice();
        $total = $subtotal + $this->getShippingCost();
        $total *= (1 + $this->getTaxRate());

        return $total;
    }
}