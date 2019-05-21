<?php


namespace App\Infrastructure\Core\Repository;


use App\Infrastructure\Core\Interfaces\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseRepository implements Repository
{
    protected $model;

    abstract protected function getModel();

    final public function __construct()
    {
        $this->model = $this->getModel();
    }
    /**
     * Get all resources
     * @param  array $options
     * @return Collection
     */
    public function get(array $options = []) :Collection
    {
        $query = $this->createBaseBuilder($options);
        return $query->get();
    }
    /**
     * Get a resource by its primary key
     * @param  mixed $id
     * @param  array $options
     * @return Collection
     */
    public function getById($id, array $options = [])
    {
        $query = $this->createBaseBuilder($options);
        return $query->find($id);
    }
    /**
     * Get all
     */
    public function getPaginate(array $options = [])
    {
        $query = $this->createBaseBuilder($options);
        $query->orderBy(
            request('order_column', $this->getCreatedAtColumn()),
            request('order_direction', 'desc')
        );
        return $query->paginate(request('limit', 10));
    }
    /**
     * Get the name of the "created at" column.
     * More info to https://laravel.com/docs/5.4/eloquent#defining-models
     * @return string
     */
    protected function getCreatedAtColumn()
    {
        $model = $this->model;
        return ($model::CREATED_AT) ? $model::CREATED_AT : 'created_at';
    }
    /**
     * Creates a new query builder with Optimus options set
     * @param  array $options
     * @return Builder
     */
    protected function createBaseBuilder(array $options = [])
    {
        $query = $this->createQueryBuilder();
        return $query;
    }
    /**
     * Creates a new query builder
     * @return Builder
     */
    protected function createQueryBuilder()
    {
        return $this->model->newQuery();
    }
    /**
     * Delete a resource by its primary key
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $query = $this->createQueryBuilder();
        $query->where($this->getPrimaryKey($query), $id);
        $query->delete();
    }
    /**
     * Get primary key name of the underlying model
     * @param  Builder $query
     * @return string
     */
    protected function getPrimaryKey(Builder $query)
    {
        return $query->getModel()->getKeyName();
    }
}
