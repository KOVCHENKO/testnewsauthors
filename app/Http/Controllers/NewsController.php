<?php

namespace App\Http\Controllers;


use App\src\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function getAll($pageNumber)
    {
        return $this->newsService->getAll($pageNumber);
    }

    public function getFiltered(Request $request)
    {
        return $this->newsService->getFiltered($request);
    }
}
