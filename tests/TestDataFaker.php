<?php

namespace Tests;

use Faker\Factory;

/**
 * Class TestDataFaker
 */
class TestDataFaker
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    /** Prepare new prospect api payload valid data with faker
     * @return array
     */
    public function prepareNewProspectValidData(): array
    {
        return [
            "campaignId" => "1",//Valid CRM campaign Id
            "email"      => $this->faker->email,
            "ipAddress"  => $this->faker->ipv4,
        ];
    }

    /** Prepare new prospect api payload invalid data with faker
     * @return array
     */
    public function prepareNewProspectInvalidData(): array
    {
        return [
            "campaignId" => "1432432",//Invalid CRM campaign Id
            "email"      => $this->faker->email,
            "ipAddress"  => $this->faker->ipv4,
        ];
    }

    /** Prepare update prospect api payload valid data with faker
     * @return array
     */
    public function prepareUpdateProspectValidData(): array
    {
        return [
            "first_name" => $this->faker->firstName,
            "last_name"  => $this->faker->lastName,
            "address"    => $this->faker->streetAddress,
            "address2"   => $this->faker->streetAddress,
            "city"       => $this->faker->city,
            "state"      => $this->faker->state,
            "zip"        => "432",
            "country"    => "GB",//valid country
            "phone"      => $this->faker->phoneNumber,
            "email"      => $this->faker->email,
            "notes"      => $this->faker->paragraph,
        ];
    }

    /** Prepare update prospect api payload invalid data with faker
     * @return array
     */
    public function prepareUpdateProspectInvalidData(): array
    {
        return [
            "first_name" => $this->faker->firstName,
            "last_name"  => $this->faker->lastName,
            "address"    => $this->faker->streetAddress,
            "address2"   => $this->faker->streetAddress,
            "city"       => $this->faker->city,
            "state"      => $this->faker->state,
            "zip"        => "432",
            "country"    => "GBFD",//Invalid country
            "phone"      => $this->faker->phoneNumber,
            "email"      => $this->faker->email,
            "notes"      => $this->faker->paragraph,
        ];
    }

    /** Prepare new upsell api payload valid data with faker
     * @return array
     */
    public function prepareNewUpsellValidData(): array
    {
        return [
            "previousOrderId" => "27159", //Valid CRM Order Id
            "shippingId"      => 8,
            "offers"          => [
                [
                    "offer_id"         => 1,
                    "product_id"       => 14,
                    "billing_model_id" => 2,
                    "quantity"         => 2,
                    "step_num"         => 2,
                ],
            ],
        ];
    }

    /** Prepare new upsell api payload invalid data with faker
     * @return array
     */
    public function prepareNewUpsellInvalidData(): array
    {
        return [
            "previousOrderId" => "2715788", //Invalid CRM Order Id
            "shippingId"      => 8,
            "offers"          => [
                [
                    "offer_id"         => 1,
                    "product_id"       => 14,
                    "billing_model_id" => 2,
                    "quantity"         => 2,
                    "step_num"         => 2,
                ],
            ],
        ];
    }

    /** Prepare new order api payload valid data with faker
     * @return array
     */
    public function prepareNewOrderValidData(): array
    {
        return [
            "firstName"             => $this->faker->firstName,
            "lastName"              => $this->faker->lastName,
            "shippingAddress1"      => $this->faker->streetAddress,
            "shippingAddress2"      => $this->faker->streetAddress,
            "shippingCity"          => $this->faker->city,
            "shippingState"         => "TX", //Valid shipping state
            "shippingZip"           => "33544",
            "shippingCountry"       => "US",
            "phone"                 => $this->faker->phoneNumber,
            "email"                 => $this->faker->email,
            "creditCardType"        => "VISA",
            "creditCardNumber"      => "1444444444444440",
            "expirationDate"        => "0628",
            "CVV"                   => "123",
            "shippingId"            => "6",
            "tranType"              => "Sale",
            "ipAddress"             => "127.0.0.1",
            "campaignId"            => "1",
            "offers"                => [
                [
                    "offer_id"         => "8",
                    "product_id"       => "4",
                    "billing_model_id" => "",
                    "quantity"         => "1",
                ],
            ],
            "billingSameAsShipping" => "Yes",
        ];
    }

    /** Prepare new order api payload invalid data with faker
     * @return array
     */
    public function prepareNewOrderInvalidData(): array
    {
        return [
            "firstName"             => $this->faker->firstName,
            "lastName"              => $this->faker->lastName,
            "shippingAddress1"      => $this->faker->streetAddress,
            "shippingAddress2"      => $this->faker->streetAddress,
            "shippingCity"          => $this->faker->city,
            "shippingState"         => "TXgdfg", //Invalid shipping state
            "shippingZip"           => "33544",
            "shippingCountry"       => "US",
            "phone"                 => $this->faker->phoneNumber,
            "email"                 => $this->faker->email,
            "creditCardType"        => "VISA",
            "creditCardNumber"      => "1444444444444440",
            "expirationDate"        => "0628",
            "CVV"                   => "123",
            "shippingId"            => "6",
            "tranType"              => "Sale",
            "ipAddress"             => "127.0.0.1",
            "campaignId"            => "1",
            "offers"                => [
                [
                    "offer_id"         => "8",
                    "product_id"       => "4",
                    "billing_model_id" => "",
                    "quantity"         => "1",
                ],
            ],
            "billingSameAsShipping" => "Yes",
        ];
    }

    /** Prepare update order api payload valid data with faker
     * @return array
     */
    public function prepareUpdateOrderValidData(): array
    {
        return [
            "order_id" => [ //Valid CRM Order Id
                "27157" => [
                    "notes"      => $this->faker->paragraph,
                    "email"      => $this->faker->email,
                    "first_name" => $this->faker->firstName,
                    "last_name"  => $this->faker->lastName,
                ],
            ],
        ];
    }

    /** Prepare update order api payload invalid data with faker
     * @return array
     */
    public function prepareUpdateOrderInvalidData(): array
    {
        return [
            "order_id" => [
                "2715788" => [ //Invalid CRM Order Id
                    "notes"      => $this->faker->paragraph,
                    "email"      => $this->faker->email,
                    "first_name" => $this->faker->firstName,
                    "last_name"  => $this->faker->lastName,
                ],
            ],
        ];
    }

    /** Prepare view order api payload valid data with faker
     * @return array
     */
    public function prepareViewOrderValidData(): array
    {
        return [
            "order_id" => [27157], //Valid CRM Order Id
        ];
    }

    /** Prepare view order api payload invalid data with faker
     * @return array
     */
    public function prepareViewOrderInvalidData(): array
    {
        return [
            "order_id" => [2715788], //Invalid CRM Order Id
        ];
    }
}
