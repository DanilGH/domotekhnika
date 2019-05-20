<?php

namespace App\Interfaces\Api\Controllers;

use App\Interfaces\Api\Requests\NewsRequest;
use App\Domain\News\News;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Interfaces\Api\Resources\News as NewsResource;

class NewsController extends Controller
{
    public function index()
    {
        return News::all();
    }

    public function store(NewsRequest $request)
    {
        $day = News::create($request->validated());
        return $day;
    }

    public function show($slug)
    {
        $news = News::where('slug', $slug)->first();
        if(!$news)
            throw new ModelNotFoundException;
        return new NewsResource($news, 'success', 'Успешно');
    }

    public function update(NewsRequest $request, $id)
    {
        $news = News::findOrFail($id);
        $news->fill($request->except(['id']));
        $news->save();
        return response()->json($news);
    }

    public function destroy(News $news)
    {
        $news = News::findOrFail($news->id);
        if($news->delete()) return response(null, 204);
    }
}
