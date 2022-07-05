<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;

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
}
