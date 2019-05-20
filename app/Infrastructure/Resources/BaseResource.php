<?php

namespace App\Infrastructure\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    public $status;
    public $message;

    public function __construct($resource, $status, $message)
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
    }

    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function with($request)
    {
        return [
            'status' => $this->status,
            'message' => $this->message
        ];
    }
}

