<?php

namespace App\Http\Controllers\Api;

use App\Repositories\GameRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameController extends Controller
{

    /**
     * @var GameRepository
     */
    private $repository;


    /**
     * GameController constructor.
     * @param GameRepository $repository
     */
    public function __construct(GameRepository $repository){

        $this->repo = $repository;
    }


    /**
     * @param Request $request
     * @return $this
     */
    public function newGame(Request $request) {

        // validate if all fields are filled
        $validator = \Validator::make($request->all(), [
            'username' => 'required|string',
            'rows' => 'required|integer',
            'cols' => 'required|integer',
            'bombs' => 'required|integer',
        ]);
        // if has fails return with errors
        if ($validator->fails()) {
            $response['errors'] = $validator->messages();
            return $response;
        }

        $data = $request->all();
        $data['status'] = 'playing';
        $data['revealed'] = 'H,H,H,H,H,H,H,H,H';

        $game = $this->repo->create($data);

        return response()->json([
            'username' => $game->username,
            'game_id' => $game->id,
            'status' => $game->status,
            'rows' => $game->rows,
            'cols' => $game->cols,
            'bombs' => $game->bombs,
            'revealed'=> $game->revealed
        ], 201)
            ->header('Content-Type', 'json/application');

    }
}
