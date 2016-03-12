<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12.03.2016
 * Time: 17:25
 */

namespace PubLeashBundle\Service;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr\OrderBy;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

class Publication
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * Publication constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param int $page
     * @return Paginator
     */
    public function getPublications($page = 1, $limit = 5) {
        $repository = $this->em->getRepository(\PubLeashBundle\Entity\Publication::class);
        $queryBuilder = $repository->createQueryBuilder('p')->orderBy('p.dateCreate', 'DESC');
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