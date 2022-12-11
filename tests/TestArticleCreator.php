<?php

declare(strict_types=1);

namespace App\Tests;

use App\Model\ArticleCreator;
use PHPUnit\Framework\TestCase;

class TestArticleCreator extends TestCase
{
    public function testArticleCreatorWithSuccess(): void
    {
        $articleCreator = new ArticleCreator();
        $article = $articleCreator->create('tresc');

        $this->assertSame('tresc', $article->getContent());
    }
}
