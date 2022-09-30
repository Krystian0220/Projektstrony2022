<?php

namespace App\Controller;

use App\Entity\Datauser;
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


        return $this->redirectToRoute(
            'app_menu', [
            'id' => $content->getId()
            ]
        );

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
    #[Route('/update{id}', name: 'app_update')]
    public function update(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $content = $entityManager->getRepository(article::class)->find($id);

        if (!$content) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $content->setContent(array_key_exists("content", $_POST) ? $_POST["content"] : "");
        $entityManager->flush();

        return $this->redirectToRoute(
            'app_menu', [
            'id' => $content->getId()
            ]
        );
    }






}
