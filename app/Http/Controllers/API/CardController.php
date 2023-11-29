<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Card;
use App\Services\CardService;
use Illuminate\Http\Response;

class CardController extends Controller
{
    /** @var carService */
    protected $cardService;

    /** CardController constructor
     * @param CardService $cardService
     */
    public function __construct(CardService $cardService)
    {
        $this->middleware('auth:api', ['except' => []]);
        $this->cardService = $cardService;
    }

    public function get(Request $request){
         try { 
             $pageSize = 5;
             if ($request['pageSize']) {
                 $pageSize = $request['pageSize'];
             }
            if($request['name']) {
                $filters = ['name' => $request['name']];
                $data = $this->cardService->get($filters, $pageSize);
            } 
            if (!$request['name']) {
                $data = $this->cardService->get([], $pageSize);
            }
            
            $result = [
                'status' => Response::HTTP_OK,
                'message' => Response::$statusTexts[Response::HTTP_OK],
                'data' => $data,
                'error' => "",
            ];
        } catch (\Throwable $th) {
            $result = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR],
                'data' => '',
                'error' =>  $th->getMessage(),
            ];
        }

        return response()->json($result)->setStatusCode($result['status'], $result['message']);
    }

    public function create(Request $request){
        try {
            $data = $request->only([
                'name',
                'hp',
                'first_edition',
                'expansion',
                'kind',
                'rarity',
                'price',
                'image',
            ]);

            $res = $this->cardService->create($data);
            return response()->json( $res, 200);

        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }

    }

     public function getById($id){
        try { 
            $data = $this->cardService->find($id);
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request,$id){
        try { 
            $data['name'] = $request['name'];
            $data['hp'] = $request['hp'];
            $data['first_edition'] = $request['first_edition']; 
            $data['expansion'] = $request['expansion'];
            $data['kind'] = $request['kind'];
            $data['rarity'] = $request['rarity'];
            $data['price'] = $request['price'];
            $data['image'] = $request['image'];
            
            $res = $this->cardService->update($id, $data);
 
            return response()->json( $res , 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }
  
    public function delete($id){
        try {       
            $res = $this->cardService->delete($id); 
            return response()->json([ "deleted" => $res ], 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }
}
