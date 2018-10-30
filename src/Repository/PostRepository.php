<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository implements PostRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
     * {@inheritdoc}
     */
    public function save(Post $post): void
    {
        $em = $this->getEntityManager();
        $em->persist($post);
        $em->flush();
    }

    public function saveAll(iterable $post): void
    {
        $em = $this->getEntityManager();
        $em->beginTransaction();

        try {
            foreach ($post as $pos) {
                $em->persist($pos);
            }

            $em->flush();
            $em->commit();
        } catch (ORMException $e) {
            $em->rollback();
        }
    }

    /**
     * @param int $count
     *
     * @return iterable
     */
    public function getLatest(int $count): iterable
    {
        $count = $count ?? 3;

        return $this->createQueryBuilder('p')
            //->join('p.category','c')
            ->select()
            ->setMaxResults($count)
            ->addOrderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $id
     *
     * @return Post
     */
    public function getById(int $id): ?Post
    {
        return $this->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getByCategory(int $id): iterable
    {
        return $this->createQueryBuilder('p')
             ->join('p.category', 'c')
             ->where("c.id = {$id}")
             ->select()
             ->addOrderBy('p.id', 'DESC')
             ->getQuery()
             ->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(int $id): void
    {
        $post = $this->getById($id);
        $em = $this->getEntityManager();
        $em->remove($post);
        $em->flush();
    }

    /**
     * Get all posts.
     *
     * @return iterable
     */
    public function getAll(): iterable
    {
        return $this->findAll();
    }
}
