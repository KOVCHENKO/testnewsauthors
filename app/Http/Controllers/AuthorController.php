<?php

namespace App\Http\Controllers;


use App\src\Repositories\AuthorRepository;

class AuthorController extends Controller
{
    protected $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function getAll()
    {
        return $this->authorRepository->getAll();
    }
}
