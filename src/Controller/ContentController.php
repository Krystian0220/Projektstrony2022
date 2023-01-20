<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\ArticleCreator;
use App\Model\ArticleUpdater;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;

class ContentController extends AbstractController
{
    private ArticleRepository $articleRepository;
    private ArticleCreator $articleCreator;
    private ArticleUpdater $articleUpdater;

    public function __construct(
        ArticleRepository $articleRepository,
        ArticleCreator $articleCreator,
        ArticleUpdater $articleUpdater
    ) {
        $this->articleRepository = $articleRepository;
        $this->articleCreator = $articleCreator;
        $this->articleUpdater = $articleUpdater;
    }

    #[Route('/content', name: 'app_content', methods: 'POST')]
    public function create(Request $request): Response
    {

        $content = $request->get('content');
        $article = $this->articleCreator->create($content);
        $this->articleRepository->save($article);

        return $this->redirectToRoute('app_menu');
    }

    #[Route('/delete/{id}', name: 'app_delete')]
    public function delete(int $id): Response
    {
        $content = $this->articleRepository->find($id);
        $this->articleRepository->delete($content);
        return $this->redirectToRoute('app_menu');
    }

    #[Route('/update{id}', name: 'app_update')]
    public function update(int $id, Request $request): Response
    {

        $news = $this->articleRepository->find($id);
        if (!$news) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }
        $content = $request->get('content');
        $article = $this->articleUpdater->update($news, $content);
        $this->articleRepository->save($article);
        return $this->redirectToRoute('app_menu');
    }
}
