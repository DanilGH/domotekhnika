<?php


namespace App\Domain\News;

use App\Infrastructure\Core\Repository\BaseRepository;
use Cviebrock\EloquentSluggable\Services\SlugService;

class NewsRepository extends BaseRepository
{
    protected function getModel()
    {
        return new News();
    }

    public function create(array $data)
    {
        $news = $this->getModel();
        $news->fill($data);
        $news->save();
        return $news;
    }

    public function update($news, $data)
    {
        $data['slug'] = SlugService::createSlug($news, 'slug', $data['title']);
        $news->fill($data);
        $news->save();
        return $news;
    }
}
