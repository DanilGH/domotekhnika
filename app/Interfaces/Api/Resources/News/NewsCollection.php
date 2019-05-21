<?php

namespace App\Interfaces\Api\Resources\News;

use App\Infrastructure\Resources\BaseResourceCollection;

class NewsCollection extends BaseResourceCollection
{
    public $collects = NewsMini::class;

    public function toArray($request)
    {
        return [
            'news' => $this->collection
        ];
    }
}
