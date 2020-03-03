<?php

namespace App\Services;


use GuzzleHttp\Client;

class ShopifyService
{

    private $shopify_admin_url;
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->shopify_admin_url = config('services.shopify.admin_api_url');
    }

    public function createProduct($data)
    {
        $url = $this->shopify_admin_url . '/products.json';
        return $this->client->post($url, ['body' => json_encode($data)])->getBody()->getContents();
    }

    public function getProducts(){
        $url = $this->shopify_admin_url . '/products.json';
        return $this->client->get($url)->getBody()->getContents();
    }
}
