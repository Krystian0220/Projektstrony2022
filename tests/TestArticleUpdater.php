<?php declare(strict_types = 1);

namespace App\Tests;

use App\Model\ArticleUpdater;
use PHPUnit\Framework\TestCase;

class TestArticleUpdater extends TestCase
{
    public function testArticleUpdaterWithSuccess(): void
    {
        $articleUpdater = new ArticleUpdater();
        $article = $articleUpdater->update(5, 'tresc');

        $this->assertSame('5', $article->getId());
        $this->assertSame('tresc', $article->getContent());
    }

}