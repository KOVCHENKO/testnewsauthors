<?php

namespace App\src\Services;


use App\src\Repositories\NewsRepository;
use Illuminate\Database\Eloquent\Collection;

class NewsService
{
    protected $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }


    public function getAll(): Collection
    {
        return $this->newsRepository->getAll();
    }

    public function getFiltered($createdAt, $authorId): Collection
    {
        return $this->newsRepository->getFiltered($createdAt, $authorId);
    }
}