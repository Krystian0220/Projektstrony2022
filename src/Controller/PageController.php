<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class PageController extends AbstractController
{
#[Route('/', name: 'app_homepage')]
public function homepage(Environment $twig): Response
{
    $html = $twig->render('Pages/index.html.twig', [
        'title' => 'Infonews',

    ]);
    return new Response($html);
}
    #[Route('/userpanel', name: 'app_menu')]
    public function UserPage(Environment $twig): Response
    {
        $html = $twig->render('Pages/zalogowany.html.twig', [
            'title' => 'Infonews',

        ]);
        return new Response($html);
    }

    #[Route('/add', name: 'app_add')]
    public function addnews(Environment $twig): Response
    {
        $html = $twig->render('Pages/dodaj.html.twig', [
            'title' => 'Infonews',

        ]);
        return new Response($html);
    }
    #[Route('/edit', name: 'app_edit')]
    public function editnews(Environment $twig): Response
    {
        $html = $twig->render('Pages/edit.html.twig', [
            'title' => 'Infonews',

        ]);
        return new Response($html);
    }



}