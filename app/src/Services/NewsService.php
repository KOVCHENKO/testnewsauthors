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

    public function getAll($data): array
    {
        $newsOfAuthor = $this->getForAuthor($data->author_id);
        $filteredByDates = $this->filterDates($newsOfAuthor, $data->date_start, $data->date_end);
        $newsAtPage = $this->getAtPage($data->page, $filteredByDates);
        $pagesQuantity = $this->getPagesQuantity($filteredByDates);

        $news['data'] = $newsAtPage->toArray();
        $news['page_quantity'] = $pagesQuantity;

        return $news;
    }

    private function getAtPage($page, Collection $news): Collection
    {
        if (!isset($page)) {
            $page = 1;
        }

        $skippedItems = ($page != 1) ? ($page - 1) * $this->newsNumberAtPage : 0;

        return $news->slice($skippedItems, $this->newsNumberAtPage);
    }

    private function getForAuthor($authorId): Collection
    {
        if (!isset($authorId)) {
            return $this->newsRepository->getAll();
        }

        return $this->newsRepository->getAllNewsOfAuthor($authorId);
    }

    private function filterDates(Collection $news, $from, $to): Collection
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

    private function getPagesQuantity(Collection $filteredByDates): int
    {
        return ceil($filteredByDates->count() / $this->newsNumberAtPage);
    }
}