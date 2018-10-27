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

	public function save( Post $post ): void {

	}

	public function saveAll( iterable $post ): void {

    	$em = $this->getEntityManager();
		$em->beginTransaction();

		try{

			foreach ($post as $pos){

				$em->persist($pos);

			}

			$em->flush();
			$em->commit();

		}catch (ORMException $e){

			$em->rollback();

		}

	}

	/**
	 * @param int $count
	 *
	 * @return iterable
	 */
	public function getLatest( int $count ): iterable {

		$count = $count ?? 3;

    	return $this->createQueryBuilder("p")
		    //->join('p.category','c')
		    ->select()
		    ->setMaxResults($count)
		    ->addOrderBy('p.id','DESC')
		    ->getQuery()
		    ->getResult();

	}

	/**
	 * @param int $id
	 *
	 * @return Post
	 */
	public function getById( int $id ): Post
	{
		return $this->find($id);
	}

	public function getByCategory( int $id ): iterable
	{
		return $this->createQueryBuilder("p")
			 ->join('p.category','c')
			 ->where("c.id = {$id}")
			 ->select()
		     ->addOrderBy('p.id','DESC')
		     ->getQuery()
		     ->getResult();
	}
}
