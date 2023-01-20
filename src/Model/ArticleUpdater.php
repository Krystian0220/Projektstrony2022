<?php

namespace App\Model;

use App\Entity\Article;

class ArticleUpdater
{
    public function update(Article $article, string $content): Article
    {
        $article->setContent($content);
        return $article;
    }
}
