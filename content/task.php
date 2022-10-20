<?php
namespace App\content;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Article;


class TaskManager
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function delete(Article $task): void
    {
        $this->entityManager->remove($task);
        $this->entityManager->flush();
    }

    public function findOneByIdAndContent(int $id, UserInterface $content): ?Article
    {
        return $this->entityManager
            ->getRepository(Article::class)
            ->findOneBy([
                'id' => $id,
                'content' => $content
            ]);
    }
}