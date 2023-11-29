<?php

namespace App\Repositories;

use App\Models\Card;
use App\RepositoriesInterfaces\CardRepositoryInterface;
use Illuminate\Pagination\CursorPaginator;

class CardRepository implements CardRepositoryInterface {
    /** @var Card */
    protected $card;

    /** CardRepository constructor
     * @param Card $card
    */
    public function __construct(Card $card) {
        $this->card = $card;
    }

    /** Get All Cards */
    public function all() {
        return $this->card->all();
    }

    /** Paginated Cards
     * @param int $pageSize
    */
    public function paginate($pageSize = null) {
        return $this->card->simplePaginate($pageSize);
    }

    /** Find Cards
     * @param array $where
    */
    public function findWhere(array $where, int $pageSize) {
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                $cards = $this->card->where($field, $condition, $val)->paginate($pageSize);
            } else {
                $cards = $this->card->where($field, '=', $value);
            }
        }
        return $cards->get();
    }

    /** Find Card
     * @param int $id
    */
    public function find($id) {
        return $this->card->find($id);
    }

    /** Create Card
     * @param array $data
     */
    public function create(array $data) {
        return $this->card->create($data);
    }
    
    /** Update Card
     * @param int $id, array $data
     */
    public function update(int $id, array $data) {
        return $this->card->find($id)->update($data);
    }

    /** Delete Card
     * @param $id
     */
    public function delete($id) {
        return $this->card->destroy($id);
    }
}   