<?php

namespace App\Interfaces\Api\Controllers;

use App\Domain\News\NewsServiceRepository;
use App\Interfaces\Api\Requests\NewsRequest;
use App\Domain\News\News;
use App\Interfaces\Api\Resources\News\NewsCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Interfaces\Api\Resources\News\News as NewsResource;

class NewsController extends Controller
{

    public function index(NewsServiceRepository $newsServiceRepository)
    {
        $news = $newsServiceRepository->getAll();
        return $this->response(
            new NewsCollection($news),
            'success',
            'Успешно');
    }

    public function show(NewsServiceRepository $newsServiceRepository, $id)
    {
        $news = $newsServiceRepository->getById($id);
        return $this->response(
            new NewsResource($news),
            'success',
            'Успешно');
    }

//==========================================================================
// DEVELOP

    public function store(NewsRequest $request)
    {
        $news = News::create($request->validated());
        return (new NewsResource($news, 'success', 'Успешно созданно'))
            ->response()->setStatusCode(201);
    }

    public function update(NewsRequest $request, $id)
    {
        $news = News::findOrFail($id);
        $news->fill($request->except(['id']));
        $news->save();
        return (new NewsResource($news, 'success', 'Успешно обновленно'))
            ->response()->setStatusCode(200);
    }

    public function destroy(NewsRequest $request, $id)
    {
        $request->validated();
        $news = News::findOrFail($id);
        if($news->delete())
            return response(null, 204);
        throw new ModelNotFoundException();
    }
}
