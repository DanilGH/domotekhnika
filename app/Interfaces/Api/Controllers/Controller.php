<?php

namespace App\Interfaces\Api\Controllers;

use App\Infrastructure\Core\Interfaces\Resource;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Infrastructure\Core\Interfaces\Controller as AController;

class Controller extends BaseController implements AController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function response(Resource $resource, $status = '', $message = '')
    {
        return $resource->additional([
            'status' => $status,
            'message' => $message
        ]);
    }
}
