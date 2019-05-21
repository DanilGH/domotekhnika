<?php

namespace App\Interfaces\Api\Resources\Error;

class ValidationErrorResource extends ErrorResource
{
    public function toArray($request)
    {
        $data = [];
        foreach ($this->resource as $item => $value){
            $data['filed'] = $item;
            $data['rule'] = $value[0];
        }
        $this->resource = $data;
        return parent::toArray($request);
    }
}
