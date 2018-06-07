<?php

namespace App\src\Services;


use App\src\Repositories\NewsRepository;
use Illuminate\Database\Eloquent\Collection;

class NewsService
{
    protected $newsNumberAtPage = 5;

    protected $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }


    public function getAll($data)
    {
        dd($data);
        $pageNumber = '';
        $skippedItems = ($pageNumber != 1) ? ($pageNumber - 1) * $this->newsNumberAtPage : 0;

        return $this->newsRepository->getAll($skippedItems, $this->newsNumberAtPage);
    }

    public function getFiltered($filterData): Collection
    {
        return $this->newsRepository->getFiltered($filterData->from, $filterData->to, $filterData->author);
    }

    public function getById($id)
    {
    }
}