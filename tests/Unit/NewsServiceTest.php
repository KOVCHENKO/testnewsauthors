<?php

namespace Tests\Unit;

use App\src\Models\News;
use App\src\Repositories\NewsRepository;
use App\src\Services\NewsService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewsServiceTest extends TestCase
{
    use DatabaseTransactions;


    public function testUserCanGetSecondPage()
    {
        factory(News::class, 10)->create();
        $newsService = new NewsService(new NewsRepository(new News()));

        $result = $newsService->getAll(2);

        $this->assertEquals(5, $result->count());
    }
}
