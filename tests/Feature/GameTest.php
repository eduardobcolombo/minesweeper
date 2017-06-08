<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use GuzzleHttp\Client;

class GameTest extends TestCase
{
    private $client = null;
    public function __construct() {
        // create our http client (Guzzle)
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://localhost:8000',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIfGetANewGame()
    {
        $data = [
            'username' => 'eduardo',
            'rows' => 3,
            'cols' => 3,
            'bombs'=> 1
        ];
        $dataExpected = [
            'username' => 'eduardo',
            'game_id' => 3,
            'status' => 'playing',
            'rows'=> 3,
            'cols'=> 3,
            'bombs'=> 1,
            'revealed'=> 'H,H,H,H,H,H,H,H,H'
        ];

        $response = $this->client->post('/api/v1/game', null, json_encode($data));

        $this->assertEquals($response->getHeaders()['Content-Type'][0],'json/application');
        $data = json_decode($response->getBody(true), true);
        $this->assertEquals($dataExpected, $data);

    }
}
