<?php
namespace App\Controller;


use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


class PageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(Environment $twig): Response
    {
        $html = $twig->render(
            'Pages/index.html.twig', [
            'title' => 'Infonews',

            ]
        );
        return new Response($html);
    }
    #[Route('/userpanel', name: 'app_menu')]
    public function UserPage(ArticleRepository $articleRepo): Response
    {
        $articles = $articleRepo->findAll();
        return $this->render(
            'Pages/zalogowany.html.twig', [
            'articles' => $articles,
            ]
        );



    }

    #[Route('/add', name: 'app_add')]
    public function addnews(Environment $twig): Response
    {
        $html = $twig->render(
            'Pages/dodaj.html.twig', [
            'title' => 'Infonews',

            ]
        );
        return new Response($html);
    }
    #[Route('/edit/{id}', name: 'app_edit')]
    public function edit(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $articles = $entityManager->getRepository(article::class)->findBy(['id' => $id]);
        if (!$articles) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }


        return $this->render(
            'Pages/edit.html.twig', [
            'articles' => $articles,
            ]
        );


    }


}