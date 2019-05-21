<?php

namespace App\Domain\News;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class News extends Model
{
    protected $fillable = ['title', 'text', 'short_text', 'slug', 'date_publish', 'status', 'image_file_name'];

    protected $hidden = ['created_at', 'updated_at'];

    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
