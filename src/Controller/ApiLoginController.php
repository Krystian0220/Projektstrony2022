<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ApiLoginController extends AbstractController
{
    #[Route('/api/login', name: 'app_api_login')]
    public function index(#[CurrentUser] ?User $user): Response
    {

        if (null === $user) {
            return $this->json(
                [
                    'message' => 'missing credentials',
                         ], Response::HTTP_UNAUTHORIZED
            );
        }

         $token = eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJxd2VydHkxMjM0IiwibmFtZSI6IktyeXN0aWFuIFB0YWsiLCJhZG1pbiI6InRydWUifQ.a_nBwUTGRIiEBgEsiM30aD-StMgrTEl1e5XD7suIQE0; // somehow create an API token for $user
        return $this->json(
            [
            'user'   => $user->getUserIdentifier(),
            'token' => $token,
            ]
        );
    }
}
