<?php

namespace App\Http\Controllers;


use App\src\Services\NewsService;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function getAll()
    {
        return $this->newsService->getAll();
    }

    public function getById($id)
    {

    }

    public function getFiltered($createdAt, $authorId)
    {

    }
}
