<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12.03.2016
 * Time: 17:25
 */

namespace PubLeashBundle\Service;


use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr\OrderBy;
use Doctrine\ORM\Query\Expr\Orx;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use PubLeashBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Publication
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * Publication constructor.
     * @param EntityManager $em
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(EntityManager $em, TokenStorageInterface $tokenStorage)
    {
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param int $page
     * @return Paginator
     */
    public function getPublications($page = 1, $limit = 5) {
        $user = $this->tokenStorage->getToken()->getUser();
        $repository = $this->em->getRepository(\PubLeashBundle\Entity\Publication::class);
        $queryBuilder = $repository->createQueryBuilder('p')->orderBy('p.dateCreate', 'DESC');
        $dateTime = new \DateTime("01/01/0001");
        dump($dateTime);
        $queryBuilder->where('p.dateDelete <= :dateTimeZero');
        $queryBuilder->setParameter('dateTimeZero', $dateTime);
        if($user instanceof User) {
            $queryBuilder->andWhere('p.isPublished = true OR :author MEMBER OF p.authors');
            $queryBuilder->setParameter('author', $user);
        } else {
            $queryBuilder->andWhere('p.isPublished = true');
        }
        return $this->paginate($queryBuilder, $page, $limit);
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    protected function paginate(QueryBuilder $queryBuilder, $page = 1, $limit = 5) {
        $paginator = new Paginator($queryBuilder);
        $paginator->getQuery()
            ->setFirstResult($limit * ($page -1 ))
            ->setMaxResults($limit);
        return $paginator;
    }
}