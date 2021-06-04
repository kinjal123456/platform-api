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

    /** Prepare new prospect api payload data with faker
     * @return array
     */
    public function prepareNewProspectData(): array
    {
        return [
            "campaignId" => "1",
            "email"      => $this->faker->email,
            "ipAddress"  => $this->faker->ipv4,
        ];
    }

    /** Prepare update prospect api payload data with faker
     * @return array
     */
    public function prepareUpdateProspectData(): array
    {
        return [
            "first_name" => $this->faker->firstName,
            "last_name"  => $this->faker->lastName,
            "address"    => $this->faker->streetAddress,
            "address2"   => $this->faker->streetAddress,
            "city"       => $this->faker->city,
            "state"      => $this->faker->state,
            "zip"        => "432",
            "country"    => "GB",
            "phone"      => $this->faker->phoneNumber,
            "email"      => $this->faker->email,
            "notes"      => $this->faker->paragraph,
        ];
    }

    /** Prepare new upsell api payload data with faker
     * @return array
     */
    public function prepareNewUpsellData(): array
    {
        return [
            "previousOrderId" => "27159",
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

    /** Prepare new order api payload data with faker
     * @return array
     */
    public function prepareNewOrderData(): array
    {
        return [
            "firstName"             => $this->faker->firstName,
            "lastName"              => $this->faker->lastName,
            "shippingAddress1"      => $this->faker->streetAddress,
            "shippingAddress2"      => $this->faker->streetAddress,
            "shippingCity"          => $this->faker->city,
            "shippingState"         => "TX",
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

    /** Prepare update order api payload data with faker
     * @return array
     */
    public function prepareUpdateOrderData(): array
    {
        return [
            "order_id" => [
                "27157" => [
                    "notes"      => $this->faker->paragraph,
                    "email"      => $this->faker->email,
                    "first_name" => $this->faker->firstName,
                    "last_name"  => $this->faker->lastName,
                ],
            ],
        ];
    }

    /** Prepare view order api payload data with faker
     * @return array
     */
    public function prepareViewOrderData(): array
    {
        return [
            "order_id" => [27157],
        ];
    }
}
