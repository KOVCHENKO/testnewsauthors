<?php

namespace App\src\Repositories;



use App\src\Models\News;
use Illuminate\Database\Eloquent\Collection;

class NewsRepository
{
    protected $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }

    public function getAll(): Collection
    {
        return $this->news
            ->with('author')
            ->get();
    }

    public function getFiltered($createdAt, $authorId): Collection
    {

    }
}