<?php

namespace App\Model;

use App\Entity\Article;
use App\Repository\ArticleRepository;


class ArticleUpdater
{
    private ArticleRepository $articleRepository;



    public function __construct(ArticleRepository $articleRepository )
    {
        $this->articleRepository = $articleRepository;

    }

    public function update(int $id, string $newcontent): Article
    {


        $article = $this->articleRepository->find($id);
        if (!$article) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }
        $article->setContent($newcontent);
        return $article;
    }



}