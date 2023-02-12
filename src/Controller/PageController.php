<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    private ArticleRepository $articleRepository;
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    #[Route('/', name: 'app_homepage')]
    public function homepage(): Response
    {
        return $this->render(
            'Pages/index.html.twig',
            [
            'title' => 'Infonews',
            ]
        );

    }
    #[Route('/menu', name: 'app_menu')]
    public function menu(): Response
    {
        $articles = $this->articleRepository->findAll();
        return $this->render(
            'Pages/zalogowany.html.twig',
            [
            'articles' => $articles,
            ]
        );
    }

    #[Route('/edit/{id}', name: 'app_edit')]
    public function edit($id): Response
    {
        $articles = $this->articleRepository->findBy(['id' => $id]);
        if (!$articles) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        return $this->render(
            'Pages/edit.html.twig',
            [
                'articles' => $articles,
            ]
        );
    }

    #[Route('/add', name: 'app_add')]
    public function addnews(): Response
    {
        return $this->render(
            'Pages/dodaj.html.twig',
            [
            'title' => 'Infonews',
            ]
        );

    }
}
