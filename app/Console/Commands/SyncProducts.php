<?php

namespace App\Console\Commands;

use App\Jobs\ProcessProduct;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class SyncProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync products to Shopify';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param Client $client
     * @return mixed
     */

    public function handle(Client $client)
    {
        //https://shopify.dev/docs/admin-api/rest/reference/products/product#create-2020-01
        //https://dog.ceo/dog-api/documentation/sub-breed
        //https://dog.ceo/api/breed/hound/list

        //TODO: input different type BUT at the same time do not break the schedule
        $breed = "hound";
        $breeds_list = json_decode($client->get(config('services.dog.api_url') . '/breed/' . $breed . '/list')->getBody()->getContents());

        $product = [
            "product" => [
                "title" => $breed,
                "body_html" => "<strong>Good snowboard!</strong>",
                "vendor" => "Awesome",
                "product_type" => "Dog",
                "variants" => [
                ]
            ]
        ];

        foreach ($breeds_list->message as $index => $sub_breed) {
            array_push($product['product']['variants'], array(
                "title" => $sub_breed,
                "option1" => $sub_breed,
                "price" => "10.00",
                "inventory_item_id" => $index,
                "inventory_level" => [
                    "inventory_item_id" => $index,
                    "available" => 9,
                ]
            ));
        }

        ProcessProduct::dispatch($product);
    }
}
