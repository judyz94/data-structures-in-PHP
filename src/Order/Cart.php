<?php

namespace src\Order;

class Cart
{
    private Customer $customer;
    private Address $shippingAddress;
    private array $items = [];

    use HasRates;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function addItem(Item $item): void
    {
        $this->items[] = $item;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function addShippingAddress(Address $address): void
    {
        $this->shippingAddress = $address;
    }

    public function getShippingAddress(): Address
    {
        return $this->shippingAddress;
    }

    public function getSubtotal(): float
    {
        $subtotal = 0;

        foreach ($this->items as $item) {
            $subtotal += $item->getItemCost();
        }

        return $subtotal;
    }

    public function getTotalCost(): float
    {
        $total = $this->getSubtotal() + $this->getShippingCost();
        $total *= (1 + $this->getTaxRate());

        return $total;
    }
}