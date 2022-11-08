<?php

namespace App\Model;

use App\Entity\Article;
use App\Repository\ArticleRepository;


class Creator
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function creater($content): void
    {
        $content = new Article($content);
        $content = $this->articleRepository->setContent('content');
        $this->articleRepository->create($content);
    }
}
