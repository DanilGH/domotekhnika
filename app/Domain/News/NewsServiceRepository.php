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

    public function getAll($options = [])
    {
        return $this->repository->get($options);
    }

    public function getById($id)
    {
        $news = $this->repository->getById($id);
        if (is_null($news)) {
            throw new ModelNotFoundException();
        }
        return $news;
    }
}
