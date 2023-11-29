<?php

namespace App\RepositoriesInterfaces;

interface CardRepositoryInterface
{
    /**
     * Retrieve all data of repository
     *
     * @return mixed
     */
    public function all();

    /**
     * Retrieve all data of repository, paginated
     *
     * @param null $pageSize
     *
     * @return mixed
     */
    public function paginate($pageSize = null);

    /**
     * Find data by multiple fields
     *
     * @param array $where, int $pageSize
     *
     * @return mixed
     */
    public function findWhere(array $where, int $pageSize);

    /**
     * Find data by id
     *
     * @param       $id
     *
     * @return mixed
     */
    public function find($id);


    /** 
     * Create Card
     * 
     * @param array $data
     */
    public function create(array $data);

    /** 
     * Update Card
     * 
     * @param int $id, array $data
     */
    public function update(int $id, array $data);

    /** 
     * Delete Card
     * 
     * @param $id
     */
    public function delete($id);
}
