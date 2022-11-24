<?php declare(strict_types = 1);

namespace App\Tests;

use App\Model\ArticleCreator;
use testarray;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function testArticleCreatorWithSuccess(): void
    {
        $articleCreator = new ArticleCreator();

        $article = $articleCreator->create('tresc');

        $this->assertSame('tresc', $article->getContent());
    }

    public function testEmpty(): array
    {
        $stack = [];
        $this->assertEmpty($stack);

        return $stack;
    }

    /**
     * @depends testEmpty
     */
    public function testPush(array $stack): array
    {
        array_push($stack, 'foo');
        $this->assertSame('foo', $stack[count($stack)-1]);
        $this->assertNotEmpty($stack);

        return $stack;
    }

    /**
     * @depends testPush
     */
    public function testPop(array $stack): void
    {
        $this->assertSame('foo', array_pop($stack));
        $this->assertEmpty($stack);
    }

    /**
     * @dataProvider additionWithNonNegativeNumbersProvider
     * @dataProvider additionWithNegativeNumbersProvider
     */
    public function testAdd(int $a, int $b, int $expected): void
    {
        $this->assertSame($expected, $a + $b);
    }

    public function additionWithNonNegativeNumbersProvider(): array
    {
        return [
            [0, 1, 1],
            [1, 0, 1],
            [1, 1, 2]
        ];
    }

    public function additionWithNegativeNumbersProvider(): array
    {
        return [
            [-1, 1, 0],
            [-1, -1, -2],
            [1, -1, 0]
        ];
    }


}


