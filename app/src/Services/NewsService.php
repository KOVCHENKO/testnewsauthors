<?php

namespace App\src\Services;


use App\src\Models\News;
use App\src\Repositories\NewsRepository;
use DateTime;
use Illuminate\Database\Eloquent\Collection;

class NewsService
{
    protected $newsNumberAtPage = 5;

    protected $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function getAll($data): Collection
    {
        $newsOfAuthor = $this->getForAuthor($data->author_id);
        $filteredByDates = $this->filterDates($newsOfAuthor, $data->date_start, $data->date_end);
        $newsAtPage = $this->getAtPage($data->page, $filteredByDates);

        return $newsAtPage;
    }

    private function getAtPage(string $page, Collection $news): Collection
    {
        if (!isset($page)) {
            $page = 1;
        }

        $skippedItems = ($page != 1) ? ($page - 1) * $this->newsNumberAtPage : 0;

        return $news->slice($skippedItems, $this->newsNumberAtPage);
    }

    private function getForAuthor(int $authorId): Collection
    {
        if (!isset($authorId)) {
            return $this->newsRepository->getAll();
        }

        return $this->newsRepository->getAllNewsOfAuthor($authorId);
    }

    private function filterDates(Collection $news, string $from, string $to): Collection
    {
        if (!isset($from) && !isset($to)) {
            return $news;
        }

        $fromDate = DateTime::createFromFormat('U', $from / 1000);
        $toDate = DateTime::createFromFormat('U', $to / 1000);

        return $news
            ->where('created_at', '>', $fromDate->format('Y-m-d H:i:s'))
            ->where('created_at', '<', $toDate);

    }

    public function getById(int $id): News
    {
        $singleNews = $this->newsRepository->getById($id);
        $authorNewsCount = $this->newsRepository->getAuthorNewsCount($singleNews->author_id);

        $singleNews->author->count = $authorNewsCount;

        return $singleNews;
    }
}