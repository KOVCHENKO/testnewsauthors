<?php

namespace App\src\Repositories;


use App\src\Models\Author;

class AuthorRepository
{
    protected $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    public function getAll()
    {
        return $this->author->all();
    }
}