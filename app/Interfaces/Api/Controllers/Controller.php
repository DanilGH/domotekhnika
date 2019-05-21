<?php

namespace App\Interfaces\Api\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Infrastructure\Core\Interfaces\Controller as AController;

class Controller extends BaseController implements AController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function response(JsonResource $resource, $status = '', $message = '') :JsonResource
    {
        return $resource->additional([
            'status' => $status,
            'message' => $message
        ]);
    }
}
