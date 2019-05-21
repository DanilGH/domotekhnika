<?php

namespace App\Interfaces\Api\Controllers;

use App\Interfaces\Api\Requests\NewsRequest;
use App\Interfaces\Api\Resources\News;

class NewsControllerTemp extends Controller
{
    public function index(News $news)
    {
        return $this->response($news);
    }

    public function store(NewsRequest $request)
    {
    }

    public function show($slug)
    {
    }

    public function update(NewsRequest $request, $id)
    {
    }

    public function destroy(NewsRequest $request, $id)
    {
    }
}
