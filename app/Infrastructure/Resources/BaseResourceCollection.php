<?php

namespace App\Infrastructure\Resources;

use App\Infrastructure\Core\Interfaces\Resource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseResourceCollection extends ResourceCollection implements Resource
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

