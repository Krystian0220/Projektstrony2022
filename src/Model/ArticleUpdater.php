<?php declare(strict_types=1);

namespace App\Model;

use App\Entity\Article;

final class ArticleUpdater
{
    public function update(Article $article, string $content): Article
    {
        $article->setContent($content);
        return $article;
    }
}
