<?php

namespace App\Infrastructure\Resources\Traits;


trait ResourceTrait
{
    public $status;
    public $message;

    public function __construct($resource, $status, $message)
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
    }

    public function with($request)
    {
        return [
            'status' => $this->status,
            'message' => $this->message
        ];
    }
}
