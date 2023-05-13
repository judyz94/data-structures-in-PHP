<?php

namespace src\Order;

class Address
{
    private string $line1;
    private string $line2;
    private string $city;
    private string $state;
    private string $zip;

    public function __construct(string $line1, string $line2, string $city, string $state, string $zip)
    {
        $this->line1 = $line1;
        $this->line2 = $line2;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function getFullAddress(): string
    {
        return $this->line1 . ' ' . $this->line2 . ', ' . $this->getCity() . ', ' . $this->getState() . ' ' . $this->getZip();
    }
}