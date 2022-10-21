<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;



class ContentController extends AbstractController
{
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    #[Route('/content', name: 'app_content')]
    public function create(Request $request): Response
    {

        $content = $request->get('content');
        $this->articleRepository->create(new Article($content));

      return $this->redirectToRoute('app_menu');

    }

    #[Route('/delete/{id}', name: 'app_delete')]
    public function delete(int $id): Response
    {

        $content = $this->articleRepository->find($id);
        $this->articleRepository->delete($content);

        return $this->redirectToRoute('app_menu' );
    }

    #[Route('/edit/{id}', name: 'app_edit')]
    public function edit($id): Response
    {

        $articles = $this->articleRepository->findBy(['id' =>$id]);
        if (!$articles) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        return $this->render(
            'Pages/edit.html.twig', [
                'articles' => $articles,

            ]
        );

    }



    #[Route('/update{id}', name: 'app_update')]
    public function update(int $id): Response
    {
        $content = $this->articleRepository->find($id);
        $this->articleRepository->update($content);

        return $this->redirectToRoute(
            'app_menu', [
                'id' => $content->getId()
            ]
        );
    }



}