<?php

namespace App\Services;

use App\RepositoriesInterfaces\CardRepositoryInterface;
use App\Repositories\CardRepository;
use App\Models\Card;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

Class CardService {
    /**
     * @var CardRepositoryInterface
     */
    protected $cardRepository;

    /**
     * CardService constructor.
     */
    public function __construct()
    {
        $this->cardRepository = new CardRepository(new Card());
    }

    /** Delete Card by id.
     * @param $id
     * @return string
     */
    public function delete($id){
        DB::beginTransaction();

        try {
            $card = $this->cardRepository->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete card :(');
        }

        DB::commit();

        return $card;
    }

    /** Get filtered/paginated Cards
     * @param array $filters, int $limit
     */
    public function get(array $filters, int $pageSize) {
        if($filters) {
            return $this->cardRepository->findWhere($filters, $pageSize);
        }
        return $this->cardRepository->paginate($pageSize);
    }

    /** Get paginated Cards
     * @param null $pageSize
    */
    public function paginate($pageSize = null) {
        return $this->cardRepository->paginate($pageSize);
    }

    /** Get all Cards */
    public function all(){
        /*dump("all");*/
        return $this->cardRepository->all();
    }

    /** Get all Cards where */
    public function findWhere(array $where, int $pageSize){
        return $this->cardRepository->findWhere($where, $pageSize);
    }

    /** Get Card by id.
     * @param $id
     */
    public function find($id){
        return $this->cardRepository->find($id);
    }

    /** Update Card by id.
     * @param $id
     */
    public function update($id, $data){
        $validator = Validator::make($data, [
            'name'  => 'bail|min:2',
            'hp' => 'bail|min:1'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $card = $this->cardRepository->update($id, $data);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update card :(');
        }

        DB::commit();

        return $card;
    }

    /** Create Card.
     * @param $data
     */
    public function create($data){
        $validator = Validator::make($data, [
            'name'          => 'required',
            'hp'            => 'required',
            'first_edition' => 'required',
            'expansion'     => 'required',
            'kind'          => 'required',
            'rarity'        => 'required',
            'price'         => 'required',
            'image'         => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $card = $this->cardRepository->create($data);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to create card :(');
        }

        DB::commit();

        return $card;
    }
}