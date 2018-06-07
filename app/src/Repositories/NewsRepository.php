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

    public function getAll()
    {
        return $this->news
            ->with('author')
            ->get();
    }

    public function getFiltered($from, $to, $authorId): Collection
    {
        return $this->news
            ->where('author_id', $authorId)
            ->whereBetween('created_at', $from, $to)
            ->get();
    }

    public function getAllNewsOfAuthor($authorId)
    {
        return $this->news
            ->where('author_id', $authorId)
            ->get();
    }

    public function getById($id)
    {
        return $this->news
            ->with('author')
            ->where('id', $id)
            ->first();
    }

    public function getAuthorNewsCount($authorId)
    {
        return $this->news
            ->where('author_id', $authorId)
            ->count();
    }
}