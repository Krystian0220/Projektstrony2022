<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Twig\Environment;

class ContentController extends AbstractController
{


    #[Route('/content', name: 'app_content')]
    public function add(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $content = new Article($_POST["content"]);

        $content->setContent(array_key_exists("content", $_POST) ? $_POST["content"] : "");

        $entityManager->persist($content);

        $entityManager->flush();

        return $this->render('Pages/dodaj.html.twig', [
            'controller_name' => 'ContentController',
        ]);

    }

    #[Route('/delete/{id}', name: 'app_delete')]
    public function UserPage(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $content = $entityManager->getRepository(Article::class)->find($id);
        $entityManager->remove($content);
        $entityManager->flush();
        return $this->redirectToRoute('app_menu');
    }

    #[Route('/test/{id}', name: 'app_test')]
    public function showcontent(Environment $twig, ArticleRepository $articleRepository, int $id): Response
    {


        return new Response($twig->render('Pages/edit.html.twig', [
                        'articles' => $articleRepository->findAll(),
                    ]));

    }




}
