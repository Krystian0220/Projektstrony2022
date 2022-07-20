<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;

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

    #[Route('/change/{id}', name: 'app_change')]
    public function changecontent(ManagerRegistry $entityManager, $id): Response
    {

        $query = $entityManager->getRepository(Article::class)->findOneBy($id);
        if (!$query) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }


        return $this->redirectToRoute('app_change');

    }




}
