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

    public function getAll(Request $request)
    {
        return $this->newsService->getAll($request->all());
    }

    public function getById($id)
    {
        return $this->newsService->getById($id);
    }
}