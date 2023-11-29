<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Card;
use Illuminate\Pagination\CursorPaginator;

class CardController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

     public function get(Request $request){
         try { 
            if($request['name']) {
                $data = Card::query()->where('name', '=', $request['name']);
                return response()->json($data->paginate(5), 200, [], 1);
            }
            $data = Card::paginate(5);
            return response()->json($data, 200, [], 1);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    public function create(Request $request){
        try {
            $data['name'] = $request['name'];
            $data['hp'] = $request['hp'];
            $data['first_edition'] = $request['first_edition']; 
            $data['expansion'] = $request['expansion'];
            $data['kind'] = $request['kind'];
            $data['rarity'] = $request['rarity'];
            $data['price'] = $request['price'];
            $data['image'] = $request['image'];

            $res = Card::create($data);
            return response()->json( $res, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

     public function getById($id){
        try { 
            $data = Card::find($id);
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
            
            Card::find($id)->update($data);
            $res = Card::find($id);
            return response()->json( $res , 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }
  
    public function delete($id){
        try {       
            $res = Card::find($id)->delete(); 
            return response()->json([ "deleted" => $res ], 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }
}
