<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use http\Env\Request;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function add(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function create(Article $content)
    {
        $tres = new Article($content);
        $tres->setContent(array_key_exists("content", $_POST) ? $_POST["content"] : "");
        $this->getEntityManager()->persist($tres);
        $this->getEntityManager()->flush();
    }
    public function delete(Article $content)
    {
        $this->getEntityManager()->remove($content);
            $this->getEntityManager()->flush();
    }

    public function update(Article $id)
    {
        $content = $this->find($id);
        if (!$content) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }
        $content->setContent(array_key_exists("content", $_POST) ? $_POST["content"] : "");
        $this->getEntityManager()->persist($content);
        $this->getEntityManager()->flush();
    }
}
