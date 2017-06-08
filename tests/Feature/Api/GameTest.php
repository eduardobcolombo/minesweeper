<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use GuzzleHttp\Client;

class GameTest extends TestCase
{

    /** Trait to solve database */
    use DatabaseTransactions;

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
     * Test if can get a new game
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
            'game_id' => 0,
            'status' => 'playing',
            'rows'=> 3,
            'cols'=> 3,
            'bombs'=> 1,
            'revealed'=> 'H,H,H,H,H,H,H,H,H'
        ];
        // send request
//        $response = $this->client->post('/api/v1/game', ['data'=>$data],json_encode($data));
        $response = $this->client->request('POST', 'http://localhost:8000/api/v1/game', [
            'json' => $data
        ]);
        // check if header is json
        $this->assertEquals($response->getHeaders()['Content-Type'][0],'json/application');
        $data = json_decode($response->getBody(true), true);
        // update game_id
        $dataExpected['game_id'] = $data['game_id'];
        // check if data is equal at expected
        $this->assertEquals($dataExpected, $data);

    }
}
