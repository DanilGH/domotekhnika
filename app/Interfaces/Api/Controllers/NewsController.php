<?php

namespace App\Interfaces\Api\Controllers;

use App\Domain\News\NewsServiceRepository;
use App\Interfaces\Api\Requests\NewsRequest;
use App\Interfaces\Api\Resources\News\NewsCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Interfaces\Api\Resources\News\News as NewsResource;

class NewsController extends Controller
{

    public function index(NewsServiceRepository $newsServiceRepository)
    {
        $news = $newsServiceRepository->getAllPaginate();
        return $this->response(new NewsCollection($news), 'success', 'Успешно')
            ->response()->setStatusCode(200);
    }

    public function show(NewsServiceRepository $newsServiceRepository, $slug)
    {
        $news = $newsServiceRepository->getBySlug($slug);
        return $this->response(new NewsResource($news), 'success', 'Успешно')
            ->response()->setStatusCode(200);
    }

    public function store(NewsServiceRepository $newsServiceRepository, NewsRequest $request)
    {
        $news = $newsServiceRepository->create($request->validated());
        return $this->response(new NewsResource($news), 'success', 'Успешно')
            ->response()->setStatusCode(201);
    }

    public function update(NewsServiceRepository $newsServiceRepository, NewsRequest $request, $id)
    {
        $news = $newsServiceRepository->update($id, $request->validated());
        return $this->response(new NewsResource($news), 'success', 'Успешно обновленно')
            ->response()->setStatusCode(200);
    }

    public function destroy(NewsServiceRepository $newsServiceRepository, NewsRequest $request, $id)
    {
        if ($newsServiceRepository->delete($id))
            return response(null, 204);
        throw new ModelNotFoundException();
    }
}
