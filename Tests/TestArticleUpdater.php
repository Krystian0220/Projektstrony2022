<?php declare(strict_types = 1);

namespace App\Tests;

use App\Model\ArticleUpdater;
use PHPUnit\Framework\TestCase;

class TestArticleUpdater extends TestCase
{


    private ArticleUpdater $articleUpdater;

    public function testArticleUpdaterWithSuccess(ArticleUpdater $articleUpdater): void
    {
        $this->articleUpdater = $articleUpdater;

        $article = $articleUpdater->update(5, 'tresc');

        $this->assertSame('5', $article->getId());
        $this->assertSame('tresc', $article->getContent());
    }

}