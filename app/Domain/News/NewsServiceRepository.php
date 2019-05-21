<?php


namespace App\Domain\News;


use App\Infrastructure\Core\Service\BaseServiceRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class NewsServiceRepository extends BaseServiceRepository
{
    public function __construct(NewsRepository $newsRepository)
    {
        $this->repository = $newsRepository;
    }

    public function getAllPaginate($options = [])
    {
        return $this->repository->getPaginate($options);
    }

    public function getById($id)
    {
        $news = $this->repository->getById($id);
        if (is_null($news)) {
            throw new ModelNotFoundException();
        }
        return $news;
    }

    public function getBySlug(string $slug)
    {
        $news = $this->repository->getWhereFirst('slug', $slug);
        if (is_null($news)) {
            throw new ModelNotFoundException();
        }
        return $news;
    }

    public function create($data)
    {
        $news = $this->repository->create($data);
        return $news;
    }

    public function update($id, $data)
    {
        $news = $this->repository->getById($id);
        $this->repository->update($news, $data);
        return $news;
    }

    public function delete($id)
    {
        $this->repository->delete($id);
        return true;
    }
}
