<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface BaseContract
{
    const LIMIT = 10;
    const ORDER_BY = 'id';
    const ORDER_DIR = 'desc';

    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * @param Model $model
     * @param array $attributes
     *
     * @return mixed
     */
    public function update(Model $model, $attributes = []);

    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function updateAll($attributes = []);

    /**
     * @param array $attributes
     * @param       $id
     *
     * @return mixed
     */
    public function createOrUpdate($attributes = [], $id = null);

    /**
     * @param array $attributes
     * @param array $identifier
     *
     * @return mixed
     */
    public function defaultUpdateOrCreate($attributes, $identifier = []);

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function remove(Model $model);

    /**
     * @param int $id
     * @param array $relations
     *
     * @return mixed
     */
    public function find(int $id, array $relations = []);

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     */
    public function findBy($key, $value);

    /**
     * @param mixed $fields
     *
     * @return mixed
     */
    public function findByFields(array $fields);

    /**
     * @param array $wheres
     * @param array|null $data
     * @return mixed
     */
    public function whereOrCreate(array $wheres, array $data = null);

    /**
     * @param string $labelField
     * @param string $valueField
     * @param bool $applyOrder
     * @param string $orderBy
     * @param string $orderDir
     * @param array $conditions
     *
     * @return mixed
     */
    public function findAllForFormSelect(
        $labelField = null,
        $valueField = 'id',
        $applyOrder = false,
        $orderBy = self::ORDER_BY,
        $orderDir = self::ORDER_DIR,
        $conditions = []
    );

    /**
     * @param array $fields
     * @param bool $applyOrder
     * @param string $orderBy
     * @param string $orderDir
     * @return mixed
     */
    public function findAll($fields = [], $applyOrder = true, $orderBy = self::ORDER_BY, $orderDir = self::ORDER_DIR);

    /**
     * @param array $filters
     * @param array $relations
     * @param bool $applyOrder
     * @param bool $page
     * @param int $limit
     * @param string $orderBy
     * @param string $orderDir
     * @param array $conditions
     * @param bool $customizePaginationURI
     * @param null $paginationURI
     * @param  $orderBy2
     * @param  $orderDir2
     * @return mixed
     */
    public function search(
        $filters = [],
        $relations = [],
        $applyOrder = true,
        $page = true,
        $limit = self::LIMIT,
        $orderBy = self::ORDER_BY,
        $orderDir = self::ORDER_DIR,
        $conditions = [],
        $customizePaginationURI = false,
        $paginationURI = null,
        $orderBy2 = null,
        $orderDir2 = null
    );

    /**
     * @param $query
     * @param bool $applyOrder
     * @param bool $page
     * @param int $limit
     * @param string $orderBy
     * @param string $orderDir
     * @param bool $customizePaginationURI
     * @param null $paginationURI
     * @return mixed
     */
    public function getQueryResult(
        $query,
        $applyOrder = true,
        $page = true,
        $limit = self::LIMIT,
        $orderBy = self::ORDER_BY,
        $orderDir = self::ORDER_DIR,
        $customizePaginationURI = false,
        $paginationURI = null
    );


    /**
     * Create a Pagination From Items Of  array Or collection.
     *
     * @param array|Collection $items
     * @param int $perPage
     * @param int $page
     * @param array $options
     *
     * @return LengthAwarePaginator
     */
    public function paginate($items, $perPage = 15, $page = null, $options = []);

}
