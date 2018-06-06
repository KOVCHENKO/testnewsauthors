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

    public function getAll($skippedItems, $numberOfItems)
    {
        return $this->news
            ->with('author')
            ->skip($skippedItems)->take($numberOfItems)->get();
    }

    public function getFiltered($from, $to, $authorId): Collection
    {
        return $this->news
            ->where('author_id', $authorId)
            ->whereBetween('created_at', $from, $to)
            ->get();
    }
}