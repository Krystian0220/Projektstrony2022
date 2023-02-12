<?php

declare(strict_types=1);

namespace App\Tests;

use App\Entity\Article;
use App\Model\ArticleUpdater;
use PHPUnit\Framework\TestCase;

class TestArticleUpdater extends TestCase
{
    public function testArticleUpdaterWithSuccess(): void
    {
        $article = new article();
        $article->tresc = 'tresc';
        $articleUpdater = new ArticleUpdater();
        $article = $articleUpdater->update(article: $article, content: 'tresc');
        $this->assertSame('tresc', $article->getContent());
    }
}
