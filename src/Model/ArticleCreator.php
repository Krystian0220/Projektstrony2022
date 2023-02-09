<?php declare(strict_types=1);

namespace App\Model;

use App\Entity\Article;

class ArticleCreator
{
    public function create(string $content): Article
    {
        $article = new Article();
        $article->setContent($content);
        return $article;
    }
}
