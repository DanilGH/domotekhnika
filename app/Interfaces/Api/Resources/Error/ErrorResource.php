<?php

namespace App\Interfaces\Api\Resources\Error;

use App\Infrastructure\Resources\BaseResource;
use App\Infrastructure\Resources\Traits\ResourceTrait;

class ErrorResource extends BaseResource
{
    use ResourceTrait;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
