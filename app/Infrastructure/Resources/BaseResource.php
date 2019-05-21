<?php

namespace App\Infrastructure\Resources;

use App\Infrastructure\Core\Interfaces\Resource;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource  implements Resource
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

