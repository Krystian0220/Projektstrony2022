<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\ArticleCreator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use App\Model\Creator;

class ContentController extends AbstractController
{
    private ArticleRepository $articleRepository;
    private ArticleCreator $articleCreator;
    private Creator $Creator;

    public function __construct(ArticleRepository $articleRepository, ArticleCreator $articleCreator)
    {
        $this->articleRepository = $articleRepository;
        $this->articleCreator = $articleCreator;
    }

    #[Route('/content', name: 'app_content')]
    public function create(Request $request, Creator $creator): Response
    {
        $this->Creator = $creator;
        $content = $request->get('content');

        $article = $this->articleCreator->create($content);
        $this->articleRepository->save($article);

        $creator->creater($content);

        $creator->creater($content);

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
        $content = $this->articleRepository->find($id);
        $this->articleRepository->update($content);
        return $this->redirectToRoute(
            'app_menu',
            [
                'id' => $content->getId()
            ]
        );
    }
}
