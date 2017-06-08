<?php
namespace App\Http\Controllers\Api;

use App\Repositories\GameRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameController extends Controller
{

    private $UNREVEALED = 'H';
    private $EMPTY = 'E';
    private $BOMB = 'B';
    /**
     * @var GameRepository
     */
    private $repository;

    private $rows;
    private $cols;
    private $bombs;
    private $revealed;

    /**
     * GameController constructor.
     * @param GameRepository $repository
     */
    public function __construct(GameRepository $repository){

        $this->repo = $repository;
    }


    /**
     * Create a new game in database and return the data
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
        $this->rows = $data['rows'];
        $this->cols = $data['cols'];
        $this->bombs = $data['bombs'];
        $this->makeRevealed();
        $data['status'] = 'playing';
        $data['revealed'] = $this->revealed;
        $data['cells'] = $this->createCells();

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
            ->header('Content-Type', 'application/json');

    }

    private function makeRevealed(){
        $count = $this->rows * $this->cols;
        $arr = [];
        for ($i =0; $i<$count;$i++){
            array_push($arr,$this->UNREVEALED);
        }
        $this->revealed = implode(',',$arr);
    }

    private function createCells() {
        $count = $this->rows * $this->cols;
        $arr = [];
//        $arr = array_fill(0, $this->rows, array_fill(0, $this->cols, $this->EMPTY);
        for ($i =0; $i<$this->rows;$i++){
            for ($j =0; $j<$this->cols;$j++) {
                array_push($arr, $this->EMPTY);
            }
        }
        for ($i =0; $i<$this->bombs;$i++) {
            $arr[rand(0,$count)] = $this->BOMB;
        }
        for ($i =0; $i<$count;$i++) {
            if ($arr[$i] != $this->BOMB) {
                $arr[$i] = rand(1,3);
            }
        }

        return implode(',',$arr);
    }
}
