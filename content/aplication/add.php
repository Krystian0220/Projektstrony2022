<?php

namespace App\Content;

use Doctrine\Persistence\ManagerRegistry;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;

class add
{
    private ManagerRegistry $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add($request): void
    {

        $content = $request->get('content');
        $add = new Article($content);
        $add->setContent(array_key_exists("content", $_POST) ? $_POST["content"] : "");
        $this->entityManager->persist($add);
        $this->entityManager->flush();
    }

}