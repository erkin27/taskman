<?php

namespace app\models\pagination;


class Pagination
{
    public $buttons = [];
    public $itemsPerPage;
    public $currentPage;

    public function __construct($itemsCount, $itemsPerPage, $currentPage)
    {
        $pagesCount = ceil((int)$itemsCount / (int)$itemsPerPage);
        $this->itemsPerPage = $itemsPerPage;
        $this->currentPage = $currentPage;

        if (!$currentPage) {
            return;
        }

        if ($pagesCount == 1) {
            return;
        }

        if ($currentPage > $pagesCount) {
            $currentPage = $pagesCount;
        }

        $this->buttons[] = new Button($currentPage - 1, $currentPage > 1, 'Previous');

        for ($i = 1; $i <= $pagesCount; $i++) {
            $active = $currentPage != $i;
            $this->buttons[] = new Button($i, $active);
        }

        $this->buttons[] = new Button($currentPage + 1, $currentPage < $pagesCount, 'Next');

    }

    public function getModels($models)
    {
        $modelsPerPage = array_chunk($models, $this->itemsPerPage);

        return $modelsPerPage[$this->currentPage-1];
    }
}