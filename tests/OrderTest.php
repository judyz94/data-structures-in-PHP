<?php

use PHPUnit\Framework\TestCase;
use src\Order\Address;
use src\Order\Cart;
use src\Order\Customer;
use src\Order\Item;

class OrderTest extends TestCase
{
    private Customer $customer;
    private Address $customerAddress1;
    private Address $customerAddress2;
    private Cart $customerCart;
    private Item $cartItem1;
    private Item $cartItem2;

    protected function setUp(): void
    {
        $this->customerAddress1 = new Address(
            '123 Main St.',
            'Apt. 3',
            'Los Angeles',
            'CA',
            '90048'
        );

        $this->customerAddress2 = new Address(
            '401 7TH AVE',
            'Apt. 19',
            'New York',
            'NY',
            '10001'
        );

        $this->customer = new Customer('Judy', 'Zapata');
        $this->customer->setAddress($this->customerAddress1);
        $this->customer->setAddress($this->customerAddress2);

        $this->customerCart = new Cart($this->customer);
        $this->cartItem1 = new Item(1, 'Laptop', 1, 4000000);
        $this->cartItem2 = new Item(7, 'Headphones', 1, 800000);

        $this->customerCart->addItem($this->cartItem1);
        $this->customerCart->addItem($this->cartItem2);

        $this->customerCart->addShippingAddress($this->customerAddress2);
    }

    public function testCanCreateAddressAndGetItSuccessfully(): void
    {
        $customerAddress1 = new Address(
            '123 Main St.',
            'Apt. 3',
            'Los Angeles',
            'CA',
            '90048'
        );

        $fullAddress = $customerAddress1->getFullAddress();

        $this->assertSame('123 Main St. Apt. 3, Los Angeles, CA 90048', $fullAddress);
    }

    public function testCanGetCustomerFullNameSuccessfully(): void
    {
        $customerName = $this->customer->getFullName();

        $this->assertSame('Judy Zapata', $customerName);
    }

    public function testCanGetCustomerAddressesSuccessfully(): void
    {
        $customerAddresses = $this->customer->getAddresses();

        $this->assertSame([$this->customerAddress1, $this->customerAddress2], $customerAddresses);
    }

    public function testCanGetItemsInCartSuccessfully(): void
    {
        $itemsInCart = $this->customerCart->getItems();

        $this->assertSame([$this->cartItem1, $this->cartItem2], $itemsInCart);
    }

    public function testCanGetShippingAddressSuccessfully(): void
    {
        $shippingAddress = $this->customerCart->getShippingAddress();

        $this->assertSame($this->customerAddress2, $shippingAddress);
    }

    public function testCanGetItemsCostSuccessfully(): void
    {
        $item1TotalCost = $this->cartItem1->getItemCost();
        $item2TotalCost = $this->cartItem2->getItemCost();

        $this->assertIsFloat($item1TotalCost);
        $this->assertIsFloat($item2TotalCost);
    }

    public function testCanGetAllCartSubtotalSuccessfully(): void
    {
        $subtotalCart = $this->customerCart->getSubtotal();

        $this->assertIsFloat($subtotalCart);
    }

    public function testCanGetAllCartTotalSuccessfully(): void
    {
        $totalCart = $this->customerCart->getTotalCost();

        $this->assertIsFloat($totalCart);
    }
}
