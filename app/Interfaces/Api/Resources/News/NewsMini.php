<?php

namespace App\Interfaces\Api\Resources\News;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsMini extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'short_text' => $this->short_text,
            'date_publish' => $this->date_publish,
            'status' => $this->status,
            'image_file_name' => $this->image_file_name
        ];
    }
}
