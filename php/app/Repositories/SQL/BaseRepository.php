<?php

namespace App\Repositories\SQL;

use App\Repositories\Contracts\BaseContract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

abstract class BaseRepository implements BaseContract
{
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function create($attributes = [])
    {
        if (!empty($attributes)) {
            // Clean the attributes from unnecessary inputs
            $filtered = $this->cleanUpAttributes($attributes);

            return $this->model->create($filtered);
        }
        return false;
    }

    /**
     * @param Model $model
     * @param array $attributes
     *
     * @return mixed
     */
    public function update(Model $model, $attributes = [])
    {
        if (!empty($attributes)) {
            // Clean the attributes from unnecessary inputs
            $filtered = $this->cleanUpAttributes($attributes);

            return tap($model)->update($filtered)->fresh();
        }
        return false;
    }

    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function updateAll($attributes = [])
    {
        if (!empty($attributes)) {
            // Clean the attributes from unnecessary inputs
            $filterd = $this->cleanUpAttributes($attributes);

            return $this->model->query()->update($filterd);
        }
        return false;
    }

    /**
     * @param array $attributes
     * @param null $id
     *
     * @return bool|mixed
     */
    public function createOrUpdate($attributes = [], $id = null)
    {
        if (empty($attributes)) {
            return false;
        }

        // Clean the attributes from unnecessary inputs
        $filtered = $this->cleanUpAttributes($attributes);

        if ($id) {
            $model = $this->model->find($id);
            return $this->update($model, $filtered);
        }
        return $this->create($filtered);
    }

    /**
     * @param array $attributes
     * @param array $identifier
     *
     * @return bool|mixed
     */
    public function defaultUpdateOrCreate($attributes, $identifier = [])
    {
        if (empty($attributes)) return false;

        // Clean the attributes from unnecessary inputs
        $attributes = $this->cleanUpAttributes($attributes);
        $identifier = $this->cleanUpAttributes($identifier);

        return $this->model::updateOrCreate($attributes, $identifier);
    }

    /**
     * @param Model $model
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function remove(Model $model)
    {
        // Check if has relations
//        foreach ($model->getDefinedRelations(true) as $relation) {
//            if ($model->$relation()->count()) {
//                throw new CantDeleteModelException("can not delete, model has related records");
//                // throw new Exception("Model has related records");
//            }
//        }

        return $model->delete();
    }

    /**
     * @return mixed
     */
    public function count()
    {
        $query = $this->model;

        return $query->count();
    }

    /**
     * @param int $id
     * @param array $relations
     *
     * @return mixed
     */
    public function find(int $id, array $relations = [])
    {
        $query = $this->model;
        if (!empty($relations)) {
            $query = $query->with($relations);
        }

        return $query->find($id);
    }

    /**
     * @param $key
     * @param $value
     *
     * @return mixed
     */
    public function findBy($key, $value)
    {
        return $this->model->where($key, $value)->firstOrFail();
    }

    /**
     * @param mixed $fields
     *
     * @return mixed
     */
    public function findByFields(array $fields)
    {
        $query = $this->model;

        if (isset($fields['and'])) {
            $query = $query->where($fields['and']);
        }

//        if (isset($fields['not_equal'])) {
//            foreach ($fields['not_equal'] as $notEqualCondition){
//                $query = $query->where($notEqualCondition[0],'!=',$notEqualCondition[1]);
//            }
//        }

        if (isset($fields['or'])) {
            $query = $query->orWhere(function (Builder $query) use ($fields) {
                foreach ($fields['or'] as $condition) {
                    $query = $query->orWhere($condition[0], $condition[1]);
                }
            });
        }

        /* foreach ($fields as $key => $value) {
            $query = $query->where($key, $value);
        } */

        return $query->first();
    }

    /**
     * @param array $values
     * @param array|null $attributes
     * @return mixed
     */
    public function whereOrCreate(array $values, array $attributes = null)
    {
        $query = $this->model;
        return $query->firstOrCreate($attributes ?? $values, $values);
    }

    /**
     * @param null $labelField
     * @param string $valueField
     * @param bool $applyOrder
     * @param string $orderBy
     * @param string $orderDir
     * @param array $conditions
     *
     * @return mixed
     */
    public function findAllForFormSelect($labelField = null, $valueField = 'id', $applyOrder = false, $orderBy = self::ORDER_BY, $orderDir = self::ORDER_DIR, $conditions = [])
    {
        $query = $this->model;
        if ($applyOrder) {
            $query = $query->orderBy($orderBy, $orderDir);
        }
        if (!empty($conditions)) {
            foreach ($conditions as $conditionType => $whereConditions) {
                if ($conditionType == 'where' && !empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->where($field, $value);
                    }
                }

                if ($conditionType == 'whereNot' && !empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->where($field, '!=', $value);
                    }
                }

                if ($conditionType == 'whereDateLess' && !empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->whereDate($field, '<=', Carbon::parse($value));
                    }
                }
                if ($conditionType == 'whereDateMore' && !empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->whereDate($field, '>=', Carbon::parse($value));
                    }
                }

                if ($conditionType == 'whereIn' && !empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->whereIn($field, $value);
                    }
                }

                if ($conditionType == 'whereNotIn' && !empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->whereNotIn($field, $value);
                    }
                }

                if ($conditionType == 'whereLike' && !empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->where($field, 'like', '%' . $value . '%');
                    }
                }

                if ($conditionType == 'whereBetween' && !empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->whereBetween($field, $value);
                    }
                }
            }

        }
        return $query->pluck($valueField, $labelField);
    }

    /**
     * @param array $fields
     * @param bool $applyOrder
     * @param string $orderBy
     * @param string $orderDir
     * @return mixed
     */
    public function findAll($fields = ['*'], $applyOrder = true, $orderBy = self::ORDER_BY, $orderDir = self::ORDER_DIR)
    {
        $query = $this->model;
        if ($applyOrder) {
            $query = $query->orderBy($orderBy, $orderDir);
        }
        return $query->get($fields);
    }

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
     * @param null $orderBy2
     * @param null $orderDir2
     *
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
    )
    {
        $query = $this->model;
        if (!empty($relations)) $query = $query->with($relations);

        if (!empty($filters)) {
            foreach ($this->model->getFilters() as $filter) {
                //if (isset($filters[$filter]) and !empty($filters[$filter])) {
                if (isset($filters[$filter])) {
                    $withFilter = "of" . ucfirst($filter);
                    $query = $query->$withFilter($filters[$filter]);
                }
            }
        }

        if (!empty($conditions)) {
            foreach ($conditions as $conditionType => $whereConditions) {
                if ($conditionType == 'where' && !empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->where($field, $value);
                    }
                }

                if ($conditionType == 'whereNot' && !empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->where($field, '!=', $value);
                    }
                }

                if ($conditionType == 'whereDateLess' && !empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->whereDate($field, '<=', Carbon::parse($value));
                    }
                }
                if ($conditionType == 'whereDateMore' && !empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->whereDate($field, '>=', Carbon::parse($value));
                    }
                }

                if ($conditionType == 'whereIn' && !empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->whereIn($field, $value);
                    }
                }

                if ($conditionType == 'whereNotIn' && !empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->whereNotIn($field, $value);
                    }
                }

                if ($conditionType == 'whereLike' && !empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->where($field, 'like', '%' . $value . '%');
                    }
                }

                if ($conditionType == 'whereBetween' && !empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->whereBetween($field, $value);
                    }
                }
            }

        }
        return $this->getQueryResult($query, $applyOrder, $page, $limit, $orderBy, $orderDir, $customizePaginationURI, $paginationURI, $orderBy2, $orderDir2);
    }

    /**
     * @param $query
     * @param bool $applyOrder
     * @param bool $page
     * @param int $limit
     * @param string $orderBy
     * @param string $orderDir
     * @param bool $customizePaginationURI
     * @param null $paginationURI
     * @param null $orderBy2
     * @param null $orderDir2
     *
     * @return mixed
     */
    public function getQueryResult($query, $applyOrder = true, $page = true, $limit = self::LIMIT, $orderBy = self::ORDER_BY, $orderDir = self::ORDER_DIR, $customizePaginationURI = false, $paginationURI = null, $orderBy2 = null,
                                   $orderDir2 = null)
    {
        if ($applyOrder) {
            $query = $query->orderBy($orderBy, $orderDir);
            if (($orderBy2 != null) && ($orderDir2 != null)) $query = $query->orderBy($orderBy2, $orderDir2);
        }

        if (config('app.query_debug')) {
            return $query->toSql();
        }
        if ($customizePaginationURI) {
            $query = $query->paginate($limit);
            return $query->withPath($paginationURI);
        }

        if ($page) return $query->paginate($limit);

        if ($limit) return $query->take($limit)->get();

        return $query->get();
    }

    protected function cleanUpAttributes($attributes)
    {
        return collect($attributes)->filter(function ($value, $key) {
            return $this->model->isFillable($key);
        })->toArray();
    }

    /**
     * @param null $groupBy
     * @param array $fields
     * @param array $filters
     * @param array $relations
     * @param bool $applyOrder
     * @param bool $page
     * @param bool $limit
     * @param string $orderBy
     * @param string $orderDir
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public function searchBySelected(
        $groupBy = null,
        $fields = [],
        $filters = [],
        $relations = [],
        $applyOrder = false,
        $page = false,
        $limit = false,
        $orderBy = self::ORDER_BY,
        $orderDir = self::ORDER_DIR
    )
    {
        $query = $this->model;

        if (!empty($relations)) {
            $query = $query->with($relations);
        }

        if (!empty($filters)) {
            foreach ($this->model->getFilters() as $filter) {
                //if (isset($filters[$filter]) and !empty($filters[$filter])) {
                if (isset($filters[$filter])) {
                    $withFilter = "of" . ucfirst($filter);
                    $query = $query->$withFilter($filters[$filter]);
                }
            }
        }

        if (!empty($fields)) $query = $query->selectRaw(implode(',', $fields));

        if (!empty($groupBy)) $query = $query->groupBy(implode(',', $groupBy));

        if ($applyOrder) $query = $query->orderBy($orderBy, $orderDir);

        if ($page) return $query->paginate($limit);

        if ($limit) return $query->take($limit)->get();

        return $query->get();
    }

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
    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
