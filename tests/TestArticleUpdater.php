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
        $article1 = new article();
        $article1->tresc = 'tresc';
        $articleUpdater = new ArticleUpdater();
        $article = $articleUpdater->update(article: $article1, content: 'tresc');
        $this->assertSame('tresc', $article->getContent());
    }
}
