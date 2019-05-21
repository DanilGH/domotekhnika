<?php


namespace App\Domain\News;

use App\Domain\News\News;
use App\Infrastructure\Core\Repository\BaseRepository;

class NewsRepository extends BaseRepository
{
    protected function getModel()
    {
        return new News();
    }
}
