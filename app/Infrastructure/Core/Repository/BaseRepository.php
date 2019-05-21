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
    public function get(array $options = [])
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
}
